<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table align="center" border="0" cellspacing="0" cellpadding="0" width="720" bgcolor="#ffffff">
        <tbody>
            <tr>
                <td align="center">
                    <a href="https://www.coolmate.me/" target="_blank"
                        data-saferedirecturl="https://www.google.com/url?q=https://www.coolmate.me/&amp;source=gmail&amp;ust=1646043960908000&amp;usg=AOvVaw3sIr9fuT7MPoCB_vsvVgRd">
                        <img src="https://ci4.googleusercontent.com/proxy/PdmdwYrL1qZ2-2fYaC0Uj7L1rlzVceRU9uwPfOppAqWffwrzkrSDy0Rj68bHAKvG_BRJG8ixgRS0R8Z-4eUGGFt6L6jdVPJKFpcaWUDcCg=s0-d-e1-ft#https://mcdn.coolmate.me/uploads/November2021/email-logo.png"
                            style="margin-bottom:16px" alt="Logo" class="CToWUd">
                    </a>
                </td>
            </tr>
            <tr>
                <td style="line-height:30px">
                    <p style="margin:0 0 10px">
                        Trong cuộc sống có rất nhiều sự lựa chọn cám ơn bạn đã chọn Electro.
                    </p>
                    <p style="margin:0">
                        Electro rất mong bạn có thể dành <b>2 phút</b> để chia sẻ cảm nhận của bạn về
                        <b>SẢN PHẨM - DỊCH VỤ - NHÂN VIÊN</b> hay bắt kỳ vấn đề gì bạn muốn nói với chúng mình để
                        Electro ngày
                        càng hoàn thiện hơn và gửi đến bạn những trải nghiệm tốt nhất trong tương lai nhé!
                    </p>
                    <p style="margin:0 0 10px">
                        Bạn có biết rằng 95% người mua sắm online tham khảo đánh giá của người mua hàng trước đó để ra
                        quyết
                        định mua sắm. Đánh giá của bạn là chính là “kim chỉ nam” để giúp khách hàng có quyết định mua
                        sắm tốt
                        nhất tại Website.
                    <p style="margin:0 0 10px">
                        Rất mong được gặp bạn trong thời gian sớm nhất!
                    </p>
                    <p style="margin:0 0 10px">
                        Yêu bạn,
                    </p>
                    <p style="margin:0 0 16px">
                        Electro team.
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="border:2px solid #2f5acf;padding:8px 16px;border-radius:16px">
                        <p style="margin:10px 0 20px;font-weight:bold;font-size:20px">
                            THÔNG TIN SẢN PHẨM
                        </p>
                        <table class="m_7863066272719237577table" cellpadding="0" cellspacing="0" border="0" width="100%"
                            style="font-size:14px;margin-bottom:8px">
                            <thead>
                                <tr>
                                    <th style="text-align:left">Tên sản phẩm</th>
                                    <th width="70px">Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_products as $item)
                                <tr>
                                    <td style="text-align:left">
                                        <div style="display:flex">
                                            <a href=""
                                                style="color:black" target="_blank">
                                                {{$item->product->product_name}}
                                            </a>
                                        </div>
                                    </td>
                                    <td align="center">
                                        {{$item->quantity}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <a href="https://coolmate.me/get-order/MjczOTYzNTg4fG1haXF1YW5naGllcDIzMTJAZ21haWwuY29t?review_token=RGR0S0gdH5LviJ5gIJ6AOtH04IUXlb9aNM6HDUgbwts6r2Yx"
                        style="display:inline-block;font-weight:bold;font-size:16px;padding:8px 30px;background-color:#f9f86c;text-decoration:none;border-radius:16px;margin:32px 0"
                        target="_blank"
                        data-saferedirecturl="https://www.google.com/url?q=https://coolmate.me/get-order/MjczOTYzNTg4fG1haXF1YW5naGllcDIzMTJAZ21haWwuY29t?review_token%3DRGR0S0gdH5LviJ5gIJ6AOtH04IUXlb9aNM6HDUgbwts6r2Yx&amp;source=gmail&amp;ust=1646043960908000&amp;usg=AOvVaw0ou4t1RR97-yxPClzIJwNV">
                        GỬI ĐÁNH GIÁ
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <hr style="height:3px;background-color:#2f5acf;border:none;margin:0">
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
