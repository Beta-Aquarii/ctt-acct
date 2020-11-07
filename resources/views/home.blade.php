@extends('layouts.app')
@section('title')
  Dashboard
@endsection
@section('content')
<style>
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
    .
</style>
<div class="col-xs-12 form-div">
        
        <div class="row">
            <div class="col-xs-12">
                @php
                  $check = array();
                @endphp
                @foreach($activities as $act)
                     @php
                        $_created = Carbon\Carbon::parse($act->created_at);
                        $created = $_created->toDateString();
                        $dispCreated = $_created->format('l, F d Y');
                        $time = $_created->format('h:i:s A');
                    @endphp
                    @if(!in_array($created, $check))
                      @php
                        $check[] = $created;
                      @endphp
                      <div class="col-xs-12 content-lower"></div>
                      <div class="col-xs-12 details-div text-center"><label class="activity-header">{{$dispCreated}}</label></div>
                      @else
                    @endif
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="panel panel-default">
                              <div class="panel-heading text-center bg-dark">
                                  @if($act->subject === "tours")
                                      <i class="fa fa-leaf size-s orange"></i>
                                  @elseif($act->subject === "users")
                                      <i class="fa fa-users size-s red"></i>
                                  @elseif($act->subject === "agents")
                                      <i class="fa fa-user-secret size-s blue"></i>
                                  @elseif($act->subject === "agent contacts")
                                      <i class="fa fa-phone-square size-s blue-2"></i>
                                  @endif
                                  <span class="text-bold white size-15">{{$time}}</span>
                              </div>
                              <div class="panel-body">
                                  <div class="col-xs-12 text-center">
                                      <label><b class="black">{{$act->user}}</b> {{$act->activity}} <b class="black">{{$act->content}}</b> in <b class="black">{{$act->subject}}</b></label>
                                  </div>
                              </div>
                          </div>
                      </div>
                @endforeach

            </div>
            <div class="col-xs-12 text-center">
                {{ $activities->links() }}
            </div>
        </div>
       

         <!--<table class="table table-hover">
               
                <tbody>
                    @foreach($activities as $act)
                        @php
                            $_created = Carbon\Carbon::parse($act->created_at);
                            $created = $_created->toDayDateTimeString();
                        @endphp
                        <tr>
                            <td class="text-left">
                                @if($act->subject === "tours")
                                    <i class="fa fa-star size-25 orange"></i>
                                @elseif($act->subject === "users")
                                    <i class="fa fa-users size-25 red"></i>
                                @elseif($act->subject === "agents")
                                    <i class="fa fa-user-secret size-25 blue-2"></i>
                                @elseif($act->subject === "agent contacts")
                                    <i class="fa fa-phone-square size-25 dark-blue"></i>
                                @endif
                            </td>
                            <td class="text-center"><b>{{$act->user}}</b> {{$act->activity}} <b>{{$act->content}}</b> in <b>{{$act->subject}}</b></td>
                            <td class="text-right">{{$created}}</td>
                        </tr>
                     @endforeach
                </tbody>
            </table>-->
    </div>
@endsection

@section('js')

@endsection
