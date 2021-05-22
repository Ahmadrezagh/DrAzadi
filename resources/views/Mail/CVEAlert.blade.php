@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
        {{setting('name')}}
        @endcomponent
    @endslot
@component('mail::message')
   <div class="text-center justify-content-center">
       <p class="text-center justify-content-center" dir="rtl" style="justify-content: center !important; text-align:center !important;" >
           انتشار آسیب پذیری سطح {{$desc}} در تاریخ {{$date}} به شناسه {{$cve_name}} در محصولات {{$brand}} . منبع :
           {{$nvd_url}}
       </p>
   </div>


@component('mail::button',['url' => $url])
    مشاهده آسیب پذیری
@endcomponent

@endcomponent

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
       تیم پشتیبانی مرکز آپا خلیج فارس بوشهر
    @endcomponent
@endslot
@endcomponent
