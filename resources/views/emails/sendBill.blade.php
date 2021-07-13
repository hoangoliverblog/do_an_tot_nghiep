<!DOCTYPE html>
<html>
<head>
    <title>Mỹ phẩm 365</title>
</head>
<body>  
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-family:arial;max-width:600px;color:#333333;text-align:center;border-bottom-width:2px;border-bottom-style:solid;border-bottom-color:#c9c9c9;border-top-left-radius:5px;border-top-right-radius:5px;border-top-width:5px;border-top-style:solid;border-top-color:#1775bc;margin-top:50px;background-image:initial;background-size:initial;background-origin:initial;background-clip:initial;background-position:initial;background-repeat:initial;background:#fff">
		<tbody>
		<tr>
		<td style="padding:30px 0px 0px">
		<h1><a href="https://thegioiskinfood.com" style="color:#333333;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://thegioiskinfood.com&amp;source=gmail&amp;ust=1624517551614000&amp;usg=AFQjCNGDl1LAx-bdeJwAOFtAGwP3hIzxgg">Shop mỹ phẩm 365 </a></h1>
		<hr style="width:570px;margin:0px auto;border-top-style:solid;border-top-color:#c9c9c9;border-bottom-style:none"></td>
		</tr>
		<tr>
		<td align="left" style="padding:20px;line-height:24px">
		<p>Chào <b>{{$data['name']}} </b>,</p>
		<p>Cám ơn bạn đã đặt hàng tại <b>Shop mỹ phẩm 365</b>! Chúng tôi gửi email này cho bạn để xác nhận đơn hàng vừa đặt</p>
		<table width="100%" style="padding:10px">
		<tbody>
		<tr>
		<td colspan="4">
		<p style="margin-bottom:15px">Mã đơn hàng: <b>{{$data['product']['id']}}</b></p>
		</td>
		</tr>
		<tr>
		<td>Hình ảnh</td>
		<td width="300px">Tên sản phẩm</td>
		<td>Số lượng</td>
		<td>Giá</td>
		</tr>
		<tr>
		<td>
		<p style="padding-right:10px"><img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fcongthucmypham.vn%2F&psig=AOvVaw3haUpB45NJ7M60jSsLtyN0&ust=1624521365104000&source=images&cd=vfe&ved=0CAoQjRxqFwoTCOjV2PKjrfECFQAAAAAdAAAAABAE" width="100px" class="CToWUd"></p>
		</td>
		<td width="300px">
		<p>{{$data['product']['name']}}</p>
		<p>SKU: {{$data['product']['id']}}</p>
		</td>
		<td>{{$data['product']['soluong']}}</td>
		<td>{{$data['product']['price']}}đ</td>
		</tr>
		 
		
		
		<tr>
		<td colspan="2">Phí vận chuyển</td>
		<td>0 VND</td>
		</tr>
		<tr>
		<td colspan="2">Tổng cộng</td>
		<td>{{$data['product']['sum']}}</td>
		</tr>
		</tbody>
		</table>
		 
		<table width="100%" style="padding:10px">
		<tbody>
		<tr>
		<td>Ngày đặt hàng</td>
		<td>{{$data['product']['timeBuy']}}</td>
		</tr>
		<tr>
		<td>Trạng thái thanh toán</td>
		<td>{{$data['product']['status']}}</td>
		</tr>
		<tr>
		<td width="50%">Phương thức thanh toán</td>
		<td>Thanh toán tiền mặt</td>
		</tr>
		<tr>
		<td>Phương thức giao hàng</td>
		<td>
		<p>Giao hàng qua bên thứ 3 là Giao Hàng Tiết Kiệm</p>
		</td>
		</tr>
		<tr>
		<td>Địa chỉ giao hàng</td>
		<td>
		<p>{{$data['product']['address']}}</p>
		<p>{{$data['product']['phone']}}</p>
		</td>
		</tr>
		</tbody>
		</table>
		</td>
		</tr>
		</tbody>
		</table>
</body>
</html>