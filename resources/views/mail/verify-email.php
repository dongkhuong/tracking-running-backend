<table style="width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;background-color: #F2F4F6" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td align="center">
                <table style="width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td style="padding: 25px 0;text-align: center">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 100%;margin: 0;padding: 0;-premailer-width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;border-top: 1px solid #EDEFF2;border-bottom: 1px solid #EDEFF2;background-color: #FFFFFF" cellpadding="0" cellspacing="0">
                                <table style="width: 570px;margin: 0 auto;padding: 0;-premailer-width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;background-color: #FFFFFF" align="center" cellpadding="0" cellspacing="0">
                                    <!-- Body content -->
                                    <tbody>
                                        <div dir="ltr">
                                            <br>
                                            <div style="text-align:center">
                                                <div style="color:rgb(71,72,81);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:15px;text-align:-webkit-center;"><b>Email Verification.</b></div>
                                            </div>
                                            <div><br></div>
                                            <div style="color:rgb(71,72,81);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:15px;">Hi <?= $verifyEmailContent['user']->firstname ?>,</div>
                                            <div><br></div>
                                            <div style="color:rgb(71,72,81);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:15px;">Thanks for registering with us! Click the button below to confirm your email address.</div>
                                            <div><br></div>
                                            <div style="text-align: center;"><a href="<?= $verifyEmailContent['urlVerifyEmail'] ?>" style="display:inline-block;color:#fff;text-decoration:none;border-radius:3px;background-color:#2196F3;border-top:10px solid #2196F3;border-right:18px solid #2196F3;border-bottom:10px solid #2196F3;border-left:18px solid #2196F3" target="_blank">Confirm Email Address</a></div>
                                            <div><br></div>
                                            <div style="color:rgb(71,72,81);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:15px;">If you have any questions, contact us.</div>
                                            <br>
                                            <div style="color:rgb(71,72,81);font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-size:15px;">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</div>
                                            <br>
                                            <a href="<?= $verifyEmailContent['urlVerifyEmail'] ?>" target="_blank">
                                                <?= $verifyEmailContent['urlVerifyEmail'] ?>
                                            </a>
                                            <br>
                                        </div>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table style="width: 570px;-premailer-width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;text-align: center;margin: 0 auto;padding: 0;-premailer-width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td style="padding-top: 10px" align="center">
                                                <p style="color: #AEAEAE;text-align: center;margin-top: 0;line-height: 1.5em;font-size: 12px">© 2019 <?= config('app.name') ?>. All rights reserved.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>