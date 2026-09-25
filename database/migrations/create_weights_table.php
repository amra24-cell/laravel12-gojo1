public function up(): void
{
    Schema::create('weights', function (Blueprint $table) {
        $table->id();
        $table->decimal('weight', 5, 2); // เก็บน้ำหนัก เช่น 65.50
        $table->date('recorded_date'); // วันที่บันทึก
        $table->timestamps();
    });
}