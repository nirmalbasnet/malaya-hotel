<div style="background: aliceblue;">
    <div style="width: 60%; background: #fff; margin: 0 auto; padding: 5%;">
        <div class="header">
            <div class="logo" style="width: 200px; margin: 0 auto;">
                <img style="width: 100%;" src="https://www.rentonnepal.com/public/m.png" alt="logo">
            </div>
        </div>


        <div class="message">
            <p>New review has been submitted for destination <strong>{{$destination->title}}</strong></p>

            <div class="reviewer">
                @php $user = \App\User::find($data['user_id']); @endphp
                <p>Reviewed By,</p>
                <p>Name: {{$user->name}}</p>
                <p>Email: {{$user->email}}</p>
            </div>
            <a href="{{url('admin/destinations/'.$destination->id.'/reviews')}}">
                <button style="padding: 10px;background: #869e39;color: #fff;border: 0;font-weight: 600;">Review Now
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

