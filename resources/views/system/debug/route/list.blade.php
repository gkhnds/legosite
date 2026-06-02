
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<br><br><br><br>
<div class="container">
 <div class="row">
     <div class="col-md-2"></div>
     <div class="col-md-8">
         <table class="table ">
             <tr>
                 <td>Component Name</td>
                 <td>Data Type</td>
                 <td></td>
             </tr>
             @foreach($Components as $Component)
                 @if($Component->component_type == 0)
                     <tr>
                         <td>{{$Component->name}}</td>
                         <td>{{$Component->data_type}}</td>
                         <td> <a href="/{{$lang}}/debug/route/{{$Component->uuid}}">view-></a></td>
                     </tr>
                 @endif
             @endforeach
         </table>
     </div>
     <div class="col-md-2"></div>
 </div>
</div>

</html>
