@extends('layouts.accounting')

@section('title')
  Cebu Trip Tours
@endsection

@section('content')
  <style>
    .form-control, .textarea, .form-control-price{
      cursor:pointer !important;
    }
    .logo-div{
      padding-bottom:30px;
    }
    .form-control{
      color:black !important;
      font-weight: bold !important;
      font-size:15px !important;
      height:50px !important;
      font-family:-webkit-pictograph !important;
    }
    
    .field-form::-webkit-input-placeholder { /* Chrome/Opera/Safari */
      color: black !important;
      font-weight:bold !important;
      font-size:15px;
      text-transform: uppercase !important;
    }
    .form-control-price::-webkit-input-placeholder { /* Chrome/Opera/Safari */
      color: black !important;
      font-weight:bold !important;
      font-size:10px !important;
      text-transform: uppercase !important;
    }
    .field-form::-moz-placeholder { /* Firefox 19+ */
         color: black !important;
        font-weight:bold !important;
        font-size:15px;
        text-transform: uppercase !important;
    }
    .field-form:-ms-input-placeholder { /* IE 10+ */
         color: black !important;
        font-weight:bold !important;
        font-size:15px;
        text-transform: uppercase !important;
    }
    .field-form:-moz-placeholder { /* Firefox 18- */
         color: black !important;
        font-weight:bold !important;
        font-size:15px;
        text-transform: uppercase !important;
    }
    
    .form-div{
      top: 60px;
    }
    h2{
      color:black;
      font-weight:bold;
    }

  </style>
  <input type="hidden" value="{{csrf_token()}}" name="deleteToken">
  @foreach($tour as $t)
    <div class="col-xs-12 form-div">
      <div class="row">

        <div class="col-xs-12 col-sm-12 well">
          <form action="" method="post">
            {{ csrf_field() }}
            <div class="col-xs-12 text-center header-div">
              <h2><i class="fa fa-btn fa-edit orange"></i> {{$t->name}}</h2>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <input type="text" class="form-control field-form" name="name" placeholder="Name" value="{{$t->name}}" required readonly>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <input type="text" class="form-control field-form" name="code" placeholder="Tour Code" value="{{$t->code}}" required readonly>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <select class="form-control" name="type" required readonly>
                  <option class="option-style" value="">TOUR TYPE</option>
                  <option class="option-style" <?php if($t->type === "Shared"){echo "selected";} ?> value="Shared">Shared Tour</option>
                  <option class="option-style" <?php if($t->type === "Private"){echo "selected";} ?> value="Private">Private Tour</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <input type="number" class="form-control field-form" min="1" name="duration" placeholder="Tour Duration" value="{{$t->duration}}" required readonly>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <input type="number" class="form-control field-form" min="0" name="lead_time" placeholder="Lead Time" value="{{$t->lead_time}}" readonly>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <input type="number" class="form-control field-form" min="1" name="min_pax" placeholder="Minimum Pax" value="{{$t->min_pax}}" readonly>
              </div>
            </div>

            <div class="col-xs-12 details-div">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                  <textarea class="textarea" placeholder="Description" name="description" readonly>
                    {!!$t->description!!}
                  </textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <textarea class="textarea" placeholder="Pick Up" name="pickup" readonly>
                  {!!$t->pick_up!!}
                </textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <textarea class="textarea" placeholder="Highlights" name="highlights" readonly>
                  {!!$t->highlights!!}
                </textarea>
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
              <div class="form-group">
                <textarea class="textarea" placeholder="Inclusions" name="inclusions" readonly>
                  {!!$t->inclusions!!}
                </textarea>
              </div>
            </div>

            <div class="col-xs-12 details-div text-center">
              <label class="size-25 black"><i class="fa fa-money green"></i> PRICES</label>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center content-lower">
              <label class="size-m" style="padding-right:5px;"><i class="fa fa-square blue-2"></i> WITH GUIDE </label>
              <label class="size-m" style="padding-left:5px;"><i class="fa fa-square dark-blue"></i> WITHOUT GUIDE</label>
            </div>
            
            @foreach($tour_pax as $tp)
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon text-bold white bg-blue-2">{{$tp->pax}} PAX</span>
                    <input type="number" class="form-control form-control-price guide-with index-0" min="100" name="w_amount[]" placeholder="Price" value="{{$tp->with_guide}}" readonly>
                    <input type="hidden" name="w_pax[]" value="{{$tp->pax}}">
                    <input type="hidden" name="w_id[]" value="{{$tp->id}}">
                    <input type="hidden" name="w_guide[]" value="with">
                    <input type="hidden" name="pax_id[]" value="{{$tp->id}}}">
                  </div>
                </div>
              </div>
            @endforeach

            <div class="col-xs-12 content-lower"></div>

            @foreach($tour_pax as $tp)
              <div class="col-xs-12 col-sm-12 col-md-2">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon text-bold white bg-dark-blue">{{$tp->pax}} PAX</span>
                    <input type="number" class="form-control form-control-price guide-without index-0" min="100" name="wo_amount[]" placeholder="Price" value="{{$tp->without_guide}}" readonly>
                    <input type="hidden" name="wo_pax[]" value="{{$tp->pax}}">
                    <input type="hidden" name="wo_id[]" value="{{$tp->id}}">
                    <input type="hidden" name="wo_guide[]" value="without">
                    <input type="hidden" name="pax_id[]" value="{{$tp->id}}}">
                  </div>
                </div>
              </div>
            @endforeach

            <div class="col-xs-12 content-lower"></div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-6">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon text-bold white bg-red span-label">Foreign Rate Additional</span>
                  <input type="number" class="form-control field-form index-0" min="0" name="foreign_rate" placeholder="Price" value="{{$t->foreign_rate}}" readonly>
                </div>
              </div>
            </div>
            <div class="col-xs-12 details-div text-center">
              <label class="size-25 black"><i class="fa fa-calendar red"></i> PEAK DATES</label>
            </div>

            <div class="row">
              @foreach($tour_peak as $tpk)
                <div class="co-xs-12 col-sm-12 col-md-6 text-right form-group">
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon text-bold white bg-dark">From</span>
                        <input type="text" name="peak_from[]" class="form-control field-form" placeholder="Date From" value="{{$tpk->from}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon text-bold white bg-dark">To</span>
                        <input type="text" name="peak_to[]" class="form-control field-form" placeholder="Date to" value="{{$tpk->to}}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                      <select class="form-control field-form" name="peak_type[]" readonly>
                        <option class="option-style" value="">AMOUNT TYPE</option>
                        <option class="option-style" <?php if($tpk->type === "amount"){echo "selected";} ?> value="amount">Amount</option>
                        <option class="option-style" <?php if($tpk->type === "percent"){echo "selected";} ?> value="percent">Percentage</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-6">
                    <input type="hidden" name="peak_id[]" value="{{$tpk->id}}">
                    <div class="form-group">
                      <input type="number" name="peak_amount[]" class="form-control field-form" placeholder="Amount" value="{{$tpk->amount}}" readonly>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="col-xs-12 content-lower"></div>
            <div class="col-xs-12 details-div"></div>
            
            <div class="col-xs-12">
              <a href="print.html" onclick="window.open('{{$t->id}}', 'newwindow','width=850,height=750'); return false;" class="btn btn-default btn-lg btn-block btn-submit"><i class="fa fa-window-restore"></i> New Window</a>
            </div>
            <div id="peak-div" class="hidden">
              <div class="co-xs-12 col-sm-12 col-md-6 text-right">
                <button class="btn btn-danger removeItem" type="button"><i class="fa fa-times"></i></button>
                <div class="col-xs-12 text-right content-lower">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <input type="text" name="peak_from[]" class="form-control field-form date-from" placeholder="Date From">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <input type="text" name="peak_to[]" class="form-control field-form date-to" placeholder="Date to">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <select class="form-control field-form" name="peak_type[]">
                      <option class="option-style" value="">AMOUNT TYPE</option>
                      <option class="option-style" value="amount">Amount</option>
                      <option class="option-style" value="percent">Percentage</option>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="peak_id[]" value="0">
                <div class="col-xs-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <input type="number" name="peak_amount[]" class="form-control field-form" placeholder="Amount">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>
  @endforeach
@endsection

@section('js')

@endsection