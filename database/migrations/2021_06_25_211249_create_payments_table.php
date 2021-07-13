<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoadon_id', 100)->comment('mã hóa đơn');
            $table->string('product_id', 5)->comment('id sản phẩm');
            $table->string('user_email', 100)->comment('email người dùng thanh toán');
            $table->float('money')->comment('số tiền thanh toán');
            $table->string('note', 255)->comment('nội dung thanh toán');
            $table->string('vpn_response_code', 255)->comment('mã phản hồi');
            $table->string('code_vnpay', 255)->comment('mã giao dịch vnpay');
            $table->string('code_bank', 255)->comment('mã ngân hàng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
