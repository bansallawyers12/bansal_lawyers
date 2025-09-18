<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td align="center" style="padding:40px 0 30px 0;background:#70bbd9;">
              <img src="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>" alt="Bansal Lawyers Logo" width="300" style="height:auto;display:block;" />
            </td>
          </tr>
          <tr>
            <td style="padding:36px 30px 42px 30px;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="padding:0 0 36px 0;color:#153643;">
                    <h1 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Appointment</h1>
                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Dear <?php echo e($details['fullname'] ?? 'Valued Client'); ?> ,</p>
                    <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><?php echo e($details['title'] ?? 'Appointment Confirmation'); ?> .</p>
                    <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;color:#ee4c50;font-weight:bold;">Appointment Details:</p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:0;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                        <tr>
                          <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                            <p style="margin:0 0 20px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Nature Of Enquiry : <?php echo e($details['NatureOfEnquiry'] ?? 'Not specified'); ?></p>
                            <p style="margin:0 0 16px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Name : <?php echo e($details['fullname'] ?? 'Not provided'); ?></p>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Phone : <?php echo e($details['phone'] ?? 'Not provided'); ?></p>
                            <p style="margin:0 0 8px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Appointment Type: <?php echo e($details['appointment_details'] ?? 'Not specified'); ?></p>
                          </td>
                          <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                          <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                            <p style="margin:0 0 20px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Service : <?php echo e($details['service'] ?? 'Not specified'); ?></p>
                            <p style="margin:0 0 16px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Email : <?php echo e($details['email'] ?? 'Not provided'); ?></p>
                            <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Date : <?php echo e($details['date'] ?? 'To be confirmed'); ?></p>
                            <p style="margin:0 0 8px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Time : <?php echo e($details['time'] ?? 'To be confirmed'); ?></p>
                          </td>
                        </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="padding:30px;background:#ee4c50;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                  <td style="padding:0;width:50%;" align="left">
                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;"> <a href="<?php echo e(URL::to('/')); ?>" style="color:#ffffff;text-decoration:underline;">Bansal Lawyers @ <?php echo e(date('Y')); ?></a>
                    </p>
                  </td>
                  <td style="padding:0;width:50%;" align="right">
                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        <td style="padding:0 0 0 10px;width:38px;">
                          <a href="https://www.instagram.com/bansallawyers?igsh=N21ubnVkeDhibjVw" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/ig_1.png" alt="Instagram" width="38" style="height:auto;display:block;border:0;" /></a>
                        </td>
                        <td style="padding:0 0 0 10px;width:38px;">
                          <a href="https://www.facebook.com/profile.php?id=61562008576642" style="color:#ffffff;"><img src="https://assets.codepen.io/210284/fb_1.png" alt="Facebook" width="38" style="height:auto;display:block;border:0;" /></a>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/emails/appointment.blade.php ENDPATH**/ ?>