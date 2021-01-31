<h3>Cảm ơn quý khách đã tin dùng!</h3>
<h4>Thông tin quý khách đã đăng ký</h4>
<li>Họ tên: <b>{{ $name }}</b></li>
<li>Địa chỉ: <b>{{ $address }}</b></li>
<li>Số điện thoại: <b>{{ $phone }}</b></li>
<li>Địa chỉ email: <b>{{ $email }}</b></li>
<h4>Chi tiết đơn hàng</h4>
<ul>
    <li>Mã đơn hàng: <b>{{ $order->code }}</b></li>
    <li>Thời gian: <b>{{ $order->created_at }}</b></li>
    <li>Phương thức thanh toán: <b>{{ $order->payment_id == 1 ? __('labels.checkout.bank') : __('labels.checkout.cod') }}</b></li>
    <li>
        <h5>Sản phẩm</h5>
        <ul>
            @foreach($order->orderDetails as $orderDetail)
                <li>{{ $orderDetail->product->name }} x {{ $orderDetail->quantity }}: <span style="color: red">{{ formatMoney($orderDetail->total) }}₫</span></li>
            @endforeach
        </ul>
        <p>Tổng: <span style="color: red">{{ formatMoney($order->orderDetails->sum('total')) }}₫</span></p>
    </li>
</ul>
