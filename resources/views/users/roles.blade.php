@extends('layouts.app')
@section('title', 'Roles & Permissions')
@section('css')
<link rel="stylesheet" href="{{ asset('dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection
@section('body')
<div class="product-list">
    <div class="card">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center mb-9">
                <h4 class="mb-0">Roles & Permissions</h4>
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addRoleModal"
                        class="btn btn-outline-primary flex-1 me-2">Add New Role</a>

                    <!-- Modal -->
                    <div class="modal fade" id="addRoleModal" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="addRoleModal"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                            <div class="modal-content p-3 p-md-3">
                                <form id="addRoleForm" class="row g-3" method="post">
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <h3 class="role-title mb-2">Add New Role</h3>
                                        <p class="text-muted">Set role permissions</p>
                                        <div class="row justify-content-center">
                                          <div class="col-md-6">
                                            @if($errors->any())
                                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                              <span class="alert-icon text-danger me-2">
                                                <i class="ti ti-ban ti-xs"></i>
                                              </span>
                                              @foreach ($errors->all() as $error)
                                                  <span class="d-block"> {{ $error }}</span>
                                              @endforeach
                                            </div>
                                            @endif
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Add role form -->

                                        @csrf
                                        <input type="hidden" id="is" name="express"/>
                                        <div class="col-12 mb-4">
                                          <label class="form-label" for="modalRoleName">Role Name</label>
                                          <input type="text" id="modalRoleName" name="name" class="form-control" placeholder="Enter a role name" tabindex="-1" value="{{ old('name') }}"/>
                                        </div>
                                        <div class="col-12">
                                          <h5>Role Permissions</h5>
                                          <!-- Permission table -->
                                          <div class="table-responsive">
                                            <table class="table table-flush-spacing">
                                              <tbody>
                                                <tr>
                                                  <td class="text-nowrap fw-semibold">Administrator Access <i class="ti ti-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system"></i></td>
                                                  <td>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" id="selectAll" />
                                                      <label class="form-check-label" for="selectAll">
                                                        Select All
                                                      </label>
                                                    </div>
                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td class="text-nowrap fw-semibold">User Management</td>
                                                  <td>
                                                    <div class="d-flex">
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="userManagementRead" name="permission[add-users]"/>
                                                        <label class="form-check-label" for="userManagementRead">
                                                          Add
                                                        </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="userManagementWrite" name="permission[edit-users]"/>
                                                        <label class="form-check-label" for="userManagementWrite">
                                                          Edit
                                                        </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="userManagementDelete" name="permission[delete-users]"/>
                                                        <label class="form-check-label" for="userManagementDelete">
                                                          Delete
                                                        </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="userManagementCreate" name="permission[view-users]"/>
                                                        <label class="form-check-label" for="userManagementCreate">
                                                          View
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </td>
                                                </tr>

                                                <tr>
                                                  <td class="text-nowrap fw-semibold">Roles</td>
                                                  <td>
                                                    <div class="d-flex">
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="rolesAdd" name="permission[add-roles]" />
                                                        <label class="form-check-label" for="rolesAdd">
                                                          Add
                                                        </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="rolesEdit" name="permission[edit-roles]" />
                                                        <label class="form-check-label" for="rolesEdit">
                                                          Edit
                                                        </label>
                                                      </div>
                                                      <div class="form-check me-3 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="rolesDelete" name="permission[delete-roles]" />
                                                        <label class="form-check-label" for="rolesDelete">
                                                          Delete
                                                        </label>
                                                      </div>
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="rolesView" name="permission[view-roles]" />
                                                        <label class="form-check-label" for="rolesView">
                                                          View
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </div>
                                          <!-- Permission table -->
                                        </div>

                                      <!--/ Add role form -->
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 add-new-role">Submit</button>
                                    <button type="button"
                                        class="btn btn-light-danger text-danger font-medium waves-effect text-start"
                                        data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->

                </div>
            </div>
            <table id="datatable" class="table align-middle text-nowrap mb-0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role Name</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Users</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="row">
                                @foreach ($role->permissions as $permission)
                                <div class="col-4">
                                <span class="badge bg-light-primary text-primary">{{ $permission->name }}</span>
                                </div>
                                @endforeach
                            </div>
                            </td>
                            <td>{{ $role->users->count() }}</td>
                            <td>{{ $role->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="btn btn-sm btn-primary role-edit-modal"><span data="@foreach($role->permissions as $permission)permission[{{$permission->name}}],@endforeach" ariaLabel="{{ $role->name }}"  ariaHidden="{{ $role->id }}">Edit Role</span></a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    "use strict";
 $(function(){
   var e,
   a=$(".datatables-users"),
   l={
     1:{
       title:"Pending",
       class:"bg-label-warning"
     },
     2:{
       title:"Active",
       class:"bg-label-success"
     },
     3:{
       title:"Inactive",
       class:"bg-label-secondary"
     }
   },
   i="app-user-view-account.html";
   a.length&&(e=a.DataTable({
     ajax:assetsPath+"json/user-list.json",
     columns:[
       {data:""},
       {data:"full_name"},
       {data:"role"},
       {data:"current_plan"},
       {data:"billing"},
       {data:"status"},
       {data:""}
     ],
     columnDefs:[
       {
         className:"control",
         orderable:!1,
         searchable:!1,
         responsivePriority:2,
         targets:0,
         render:function(e,a,t,s){
           return""
         }
       },
       {
         targets:1,
         responsivePriority:4,
         render:function(e,a,t,s){
           var l=t.full_name,n=t.email,r=t.avatar;
           return'<div class="d-flex justify-content-left align-items-center"><div class="avatar-wrapper"><div class="avatar avatar-sm me-3">'+(r?'<img src="'+assetsPath+"img/avatars/"+r+'" alt="Avatar" class="rounded-circle">':'<span class="avatar-initial rounded-circle bg-label-'+["success","danger","warning","info","primary","secondary"][Math.floor(6*Math.random())]+'">'+(r=(((r=(l=t.full_name).match(/\b\w/g)||[]).shift()||"")+(r.pop()||"")).toUpperCase())+"</span>")+'</div></div><div class="d-flex flex-column"><a href="'+i+'" class="text-body text-truncate"><span class="fw-semibold">'+l+'</span></a><small class="text-muted">@'+n+"</small></div></div>"
         }
       },
       {
         targets:2,
         render:function(e,a,t,s){
           t=t.role;
           return"<span class='text-truncate d-flex align-items-center'>"+{
             Subscriber:'<span class="badge badge-center rounded-pill bg-label-warning me-3 w-px-30 h-px-30"><i class="ti ti-user ti-sm"></i></span>',
             Author:'<span class="badge badge-center rounded-pill bg-label-success me-3 w-px-30 h-px-30"><i class="ti ti-settings ti-sm"></i></span>',
             Maintainer:'<span class="badge badge-center rounded-pill bg-label-primary me-3 w-px-30 h-px-30"><i class="ti ti-chart-pie-2 ti-sm"></i></span>',
             Editor:'<span class="badge badge-center rounded-pill bg-label-info me-3 w-px-30 h-px-30"><i class="ti ti-edit ti-sm"></i></span>',
             Admin:'<span class="badge badge-center rounded-pill bg-label-secondary me-3 w-px-30 h-px-30"><i class="ti ti-device-laptop ti-sm"></i></span>'
           }[t]+t+"</span>"
         }
       },
       {
         targets:3,
         render:function(e,a,t,s){
           return'<span class="fw-semibold">'+t.current_plan+"</span>"
         }
       },
       {
         targets:5,
         render:function(e,a,t,s){
           t=t.status;
           return'<span class="badge '+l[t].class+'" text-capitalized>'+l[t].title+"</span>"
         }
       },
       {
         targets:-1,
         title:"Actions",
         searchable:!1,
         orderable:!1,
         render:function(e,a,t,s){
           return'<div class="d-flex align-items-center"><a href="'+i+'" class="btn btn-sm btn-icon"><i class="ti ti-eye"></i></a><a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a><a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a><div class="dropdown-menu dropdown-menu-end m-0"><a href="javascript:;"" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Suspend</a></div></div>'
         }
       }
     ],
     order:[
       [1,"desc"]
     ],
     dom:'<"row mx-2"<"col-sm-12 col-md-4 col-lg-6" l><"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
     language:{
       sLengthMenu:"Show _MENU_",
       search:"Search",
       searchPlaceholder:"Search.."
     },
     responsive:{
       details:{
         display:$.fn.dataTable.Responsive.display.modal({
           header:function(e){
             return"Details of "+e.data().full_name
           }
         }),
         type:"column",
         renderer:function(e,a,t){
           t=$.map(t,function(e,a){
             return""!==e.title?'<tr data-dt-row="'+e.rowIndex+'" data-dt-column="'+e.columnIndex+'"><td>'+e.title+":</td> <td>"+e.data+"</td></tr>":""
           }).join("");
           return!!t&&$('<table class="table"/><tbody />').append(t)
         }
       }
     },
     initComplete:function(){
       this.api().columns(2).every(function(){
         var a=this,
         t=$('<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>').appendTo(".user_role").on("change",function(){
           var e=$.fn.dataTable.util.escapeRegex($(this).val());
           a.search(e?"^"+e+"$":"",!0,!1).draw()
         });
         a.data().unique().sort().each(function(e,a){
           t.append('<option value="'+e+'" class="text-capitalize">'+e+"</option>")
         })
       })
     }
   })),
   $(".datatables-users tbody").on("click",".delete-record",function(){
     e.row($(this).parents("tr")).remove().draw()
   }),
   setTimeout(()=>{
     $(".dataTables_filter .form-control").removeClass("form-control-sm"),
     $(".dataTables_length .form-select").removeClass("form-select-sm")
   },300)
 }),
 function(){
   var e=document.querySelectorAll(".role-edit-modal"),
   a=document.querySelector(".add-new-role"),
   b=document.querySelector("#modalRoleName"),
   h=document.querySelector("#is"),
   o=document.querySelectorAll('[type="checkbox"]'),
   t=document.querySelector(".role-title");
   a.onclick=function(){
     t.innerHTML="Add New Role";
     h.value = '0';
   },
   e&&e.forEach(function(e){
     e.onclick=function(event){
       b.value = event.target.attributes[1].value;
       h.value = event.target.attributes[2].value;
       let permissions = event.target.attributes[0].value.split(',');
       o.forEach(e=>{
         e.checked= e.name&&permissions.includes(e.name) ? true : false;
       })
       t.innerHTML="Edit Role"
     }
   })
 }();
 </script>
 <script>
     // Get the "Select All" checkbox
     var selectAll = document.getElementById("selectAll");
     // Get all the checkboxes
     var checkboxes = document.querySelectorAll(".form-check-input");

     // Add event listener to the "Select All" checkbox
     selectAll.addEventListener("change", function() {
       // Loop through all checkboxes
       checkboxes.forEach(function(checkbox) {
         // Set the checked state of each checkbox to the state of the "Select All" checkbox
         checkbox.checked = selectAll.checked;
       });
     });

     // Add event listener to each checkbox
     checkboxes.forEach(function(checkbox) {
       checkbox.addEventListener("change", function() {
         // If any checkbox is unchecked, uncheck the "Select All" checkbox
         if (!this.checked) {
           selectAll.checked = false;
         }
         // If all checkboxes are checked, check the "Select All" checkbox
         else if ([...checkboxes].every(c => c.checked)) {
           selectAll.checked = true;
         }
       });
     });
   </script>

<!-- ---------------------------------------------- -->
<script src="{{ asset('dist/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/libs/datatables.net/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(function () {
        $("#datatable").DataTable({});
    });

 @if($errors->any())
var myModal = new bootstrap.Modal(document.getElementById('addRoleModal'), {
  keyboard: false
})
myModal.show()
@endif

</script>
@endsection
