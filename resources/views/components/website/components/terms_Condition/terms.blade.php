<div id="page">
    <div class="terms_banner">
        <h1>Terms & Condations</h1>
        <p>Work with the most talented candidates in the world</p>
    </div>
    @php
        $title     = 'title_'.config('app.locale');
        $sub_title = 'sub_title_'.config('app.locale');
        $content   = 'content_'.config('app.locale');
    @endphp
    <div class="terms">
        <div class="container" >
                <div class="row ">
                <div class="terms_header">
                    <h1>Apple Terms and Conditions</h1>
                    <p class="lastupdate"> Last Updated :  <span>[{{\Carbon\Carbon::parse(\App\Models\Term::orderBy('updated_at','desc')->value('updated_at'))->format('d/m/Y')}}]</span></p>
                    <p class="header_subtitle">
                    {{\App\Models\TermHeader::where('id',1)->value('header_'.config('app.locale'))}}
                    </p>
                </div>

                <div class="body">

                    @foreach(\App\Models\Term::latest()->get() as $pKey => $terms)
                        @php
                            $pKey = ++$pKey;
                        @endphp
                        <div class="body_title">
                            <p>{{$pKey . ' . ' . $terms->$title}}</p>
                                <div class="body_subtitle">
                                @if (!empty($terms->$sub_title))
                                     <h3>{{$terms->$sub_title}}</h3>
                                @endif
                                    @foreach($terms->$content as $sKey => $sonTerms)
                                            <p  class="list_subtitle">{{$pKey . '.'.$sKey . ' . ' . $sonTerms}}</p>
                                        @endforeach

                                </div>
                        </div>
                    @endforeach


                </div>
                </div>
       </div>
    </div>



</div>

