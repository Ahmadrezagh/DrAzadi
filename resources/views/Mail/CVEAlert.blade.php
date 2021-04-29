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
           آسیب پذیری جدید با درجه خطر {{$desc}} با نام {{$cve_name}} گزارش شد.
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
