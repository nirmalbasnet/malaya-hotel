<div style="background: aliceblue;">
    <div style="width: 60%; background: #fff; margin: 0 auto; padding: 5%;">
        <div class="header">
            <div class="logo" style="width: 200px; margin: 0 auto;">
                <img style="width: 100%;" src="https://www.rentonnepal.com/public/m.png" alt="logo">
            </div>
        </div>


        <div class="message">
            <p>A new booking request has been submitted for destination <strong>{{$destination->title}}</strong></p>

            <div class="reviewer">
                <p>Booking Detail,</p>
                <p>Name: {{$data['booker_name']}}</p>
                <p>Email: {{$data['booker_email']}}</p>
                <p>No. Of People: {{$data['no_of_people']}}</p>
            </div>
            <a href="{{url('admin/bookings')}}">
                <button style="padding: 10px;background: #869e39;color: #fff;border: 0;font-weight: 600;">See in admin
                    dashboard
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

