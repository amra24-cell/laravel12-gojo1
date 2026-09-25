<x-weight>
    <x-slot name="title">หน้าจัดการน้ำหนัก</x-slot>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">➕ บันทึกน้ำหนักใหม่</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('weights.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">วันที่บันทึก</label>
                            <input type="date" name="recorded_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">น้ำหนัก (กิโลกรัม)</label>
                            <input type="number" step="0.01" name="weight" class="form-control" placeholder="เช่น 65.5" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">บันทึกข้อมูล</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div id="curve_chart" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-white">
            <h5 class="mb-0">📋 ประวัติการบันทึกน้ำหนัก</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th>วันที่</th>
                        <th>น้ำหนัก (กก.)</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($weights as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->recorded_date)->format('d/m/Y') }}</td>
                            <td>{{ $item->weight }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                    แก้ไข
                                </button>
                                
                                <form action="{{ route('weights.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('ต้องการลบข้อมูลนี้หรือไม่?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>

                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('weights.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">แก้ไขข้อมูลน้ำหนัก</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-start">
                                            <div class="mb-3">
                                                <label class="form-label">วันที่บันทึก</label>
                                                <input type="date" name="recorded_date" class="form-control" value="{{ $item->recorded_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">น้ำหนัก (กิโลกรัม)</label>
                                                <input type="number" step="0.01" name="weight" class="form-control" value="{{ $item->weight }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            <button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <x-slot name="scripts">
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Weight'],
                    // วนลูปข้อมูลจาก Controller มาใส่ใน JS Array
                    @foreach($weights as $item)
                        ['{{ \Carbon\Carbon::parse($item->recorded_date)->format('d/m/Y') }}', {{ $item->weight }}],
                    @endforeach
                ]);

                var options = {
                    title: 'แนวโน้มน้ำหนักร่างกาย',
                    curveType: 'function',
                    legend: { position: 'bottom' },
                    hAxis: { title: 'วันที่' },
                    vAxis: { title: 'น้ำหนัก (กก.)' },
                    colors: ['#0d6efd']
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                chart.draw(data, options);
            }
        </script>
    </x-slot>
</x-weight>