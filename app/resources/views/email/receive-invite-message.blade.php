<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head></head>
<body>


<div style="font-size:13px;line-height:22px;Margin:0;color:#333333;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%;background-color:#eeeeee;font-family:tahoma,sans-serif">
    <center style="width:100%;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;table-layout:fixed;background-color:#eeeeee">
        <div style="padding-top:0;padding-bottom:0;padding-right:10px;padding-left:10px">

            <table align="center" style="font-size:13px;line-height:22px;color:#333333;border-spacing:0;font-family:tahoma,sans-serif;border-radius:7px;max-width:700px;Margin:0 auto;width:100%;background-color:#ffffff;direction:rtl">
                <tbody>

                <tr>
                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right;font-size:1px!important;line-height:1px!important;height:4px!important;background-color:#fbb63a;background-image:none;background-repeat:repeat;background-position:top left">

                    </td>
                </tr>
                <tr>
                    <td class="m_-6790710681601222834two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:center;font-size:0">

                        <div class="m_-6790710681601222834column" style="width:100%;max-width:400px;display:inline-block;vertical-align:top">
                            <table width="100%" style="font-size:13px;line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif">
                                <tbody><tr>
                                    <td style="font-family:tahoma,sans-serif;text-align:right;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px">
                                        <table style="line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif;font-size:13px;text-align:right">
                                            <tbody><tr>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0">کاربرگرامی، <strong>{{$receiver_name }}</strong><br>
                                                        فردی در وب سایت {{$website_name}} برای شما یک دعوتنامه ارسال کرده است.:
                                                    </p>
                                                </td>
                                            </tr>


                                         </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                        <div class="m_-6790710681601222834column" style="width:100%;max-width:400px;display:inline-block;vertical-align:top">
                            <table width="100%" style="font-size:13px;line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif">
                                <tbody><tr>
                                    <td style="font-family:tahoma,sans-serif;text-align:right;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px">
                                        <table style="line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif;font-size:13px;text-align:right">
                                            <tbody>
                                            <tr>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0">
                                                        نام ارسال کننده :
                                                    </p>
                                                </td>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <span dir="ltr">{{$sender_name}}</span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0">

                                                        نام رویداد:
                                                    </p>
                                                </td>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <span dir="ltr">{{$event_name}} </span>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0">

                                                        زمان رویداد:
                                                    </p>
                                                </td>
                                                <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                                                    <span dir="ltr">{{($event_name_created_at == '' ? 'تعیین نشده' : jdate($event_name_created_at)->format('Y-m-d H:i:s'))}} </span>
                                                </td>

                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>


                    </td>
                </tr>





                <tr>
                    <td style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:right">
                        <table width="100%" style="font-size:13px;line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif">
                            <tbody><tr>
                                <td style="font-family:tahoma,sans-serif;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px;text-align:right;font-size:13px">
                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0"><strong>دانلود اپلیکیشن موبایل:</strong></p>
                                    <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;Margin:1em 0">با استفاده از اپلیکیشن می‌توانید از خدمات وب سایت

                                        بر روی گوشی و تبلت‌های هوشمند مبتنی بر Android و یا iOS خود استفاده کنید.

                                    </p>
                                </td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td class="m_-6790710681601222834two-column" style="padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:tahoma,sans-serif;text-align:center;font-size:0">

                        <div class="m_-6790710681601222834column" style="width:100%;max-width:400px;display:inline-block;vertical-align:top">
                            <table width="100%" style="font-size:13px;line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif">
                                <tbody><tr>
                                    <td style="font-family:tahoma,sans-serif;text-align:right;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px">
                                        <a href="{{$androidUrl}}" style="color:#44b9fa;text-decoration:underline;font-size:16px" target="_blank"  ><img src="https://ci5.googleusercontent.com/proxy/f_DjEG65jAkcmZlUJWgANyvfqirwDpfXeQSyEenjxG9yIuik9UQRE-YcKbqO2IJHqExoUJ2aGlwAJOPtCzdHEJaqBzKJVyTlR2kQItKVRZxSz2jbDUCDNiyYQ0MXhRVw9di_F9CK8tOwsoO7x_aautupLPWI7VLCjl8-94hmuUUnCqbRaVRXNkL_r40qhIOlPg=s0-d-e1-ft#http://www.shatel.ir/PortalData/Subsystems/StaticContent/uploads/Image/general/rtl/InvoiceEmail_Image/android_app_download.png" alt="دانلود اپلیکیشن اندروید" title="دانلود اپلیکیشن اندروید" width="310" style="border-width:0;max-width:360px;min-height:45px;width:auto!important;height:auto!important" class="CToWUd"></a>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                        <div class="m_-6790710681601222834column" style="width:100%;max-width:400px;display:inline-block;vertical-align:top">
                            <table width="100%" style="font-size:13px;line-height:22px;Margin:0;color:#333333;border-spacing:0;font-family:tahoma,sans-serif">
                                <tbody><tr>
                                    <td style="font-family:tahoma,sans-serif;text-align:right;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px">
                                        <a href="{{$iosUrl}}" style="color:#44b9fa;text-decoration:underline;font-size:16px" target="_blank"  ><img src="https://ci6.googleusercontent.com/proxy/eW2N1EkTa2Mba4nZvszxxGhisocg7wUWo21YaPi52XWjQZtbIuQ3rlWScw01tPM_ccFKEBBPnYXr_tmPOjGh83XCNNamVsKuOJsTuiZK52wvp7BeejhS-pxK6Z_T3MN6wvJOw_TTFL287g4CuuR7xF_D7lBNUrt7ROQXjIO7rrE6hZHsaDr1N_goeWJc=s0-d-e1-ft#http://www.shatel.ir/PortalData/Subsystems/StaticContent/uploads/Image/general/rtl/InvoiceEmail_Image/ios_app_download.png" alt="دانلود اپلیکیشن iOS" title="دانلود اپلیکیشن iOS" width="310" style="border-width:0;max-width:360px;min-height:45px;width:auto!important;height:auto!important" class="CToWUd"></a>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                    </td>
                </tr>
                <tr>
                    <td dir="rtl" style="font-family:tahoma,sans-serif;text-align:right;padding-top:0;padding-bottom:20px;padding-right:20px;padding-left:20px">

                    </td>
                </tr>
                </tbody></table>
            <p dir="rtl" style="font-size:13px;line-height:22px;color:#333333;text-align:center;max-width:700px;Margin:30px auto 0">This email is sent by {{url('/')}}.</p>

        </div>

    </center><div class="yj6qo"></div><div class="adL">
    </div></div>
</body>
</html>
