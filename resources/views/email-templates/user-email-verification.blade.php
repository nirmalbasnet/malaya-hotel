<div style="background: aliceblue;">
    <div style="width: 60%; background: #fff; margin: 0 auto; padding: 5%;">
        <div class="header">
            <div class="logo" style="width: 200px; margin: 0 auto;">
                <img style="width: 100%;" src="https://www.rentonnepal.com/public/m.png" alt="logo">
            </div>
        </div>

        <div class="greetings">
            <p style="display: block;">Hello {{$data['name']}},</p>
            <p style="display: block;">Greetings from Malaya Pvt. Ltd.</p>
        </div>

        <div class="message">
            <p>Thank you for registering with us. Please click the verification button below to verify your account.</p>
            <a href="{{url('email-verification?token='.$data['email_verification_token'])}}">
                <button style="padding: 10px;background: #869e39;color: #fff;border: 0;font-weight: 600;">Verify Your
                    Account
                </button>
            </a>
        </div>

        <div class="footer" style="font-weight: 600; color: #000; width: 100%; text-align: left; margin-top: 15px;">
            <p style="display: block; font-size: 15px; margin-bottom: 0; color: #000; opacity: 0.5; width: 100%; text-align: left;">
                Regards,</p>
            <a style="display: block; font-size: 15px;" href="{{url('/')}}">Malaya Pvt. Ltd.</a>
        </div>
    </div>
</div>

