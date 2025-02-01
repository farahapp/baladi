
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div  class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('userProfile.index') }}" class="d-block"  style="color: #EF4C2B">{{ auth()->user()->name; }}</a>
        <a href="{{ route('userProfile.index') }}" class="d-block" style="color: #FBA82E">{{ auth()->user()->permission_rols->name; }}</a>
        {{-- @if (auth()->user()->is_master_Admin==0)
          
        @endif --}}
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        {{-- =========================(بداية الضبط العام)=========== --}}
       @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(5)==true)
        <li  class="nav-item has-treeview    {{ ( request()->is('*/admin/generalSettings*') || request()->is('*/admin/finance_calender*') || request()->is('*/admin/branches*')  || request()->is('*/admin/departements*')  || request()->is('*/admin/jobs_categories*') || request()->is('*/admin/Qualifications*') || request()->is('*/admin/occasions*') || request()->is('*/admin/Resignations*') || request()->is('*/admin/Nationalities*') || request()->is('*/admin/Religions*')|| request()->is('*/admin/VehicleType*')|| request()->is('*/admin/VehicleModel*')) ? 'menu-open':'' }} ">
          <a  href="#" class="nav-link {{ ( request()->is('*/admin/generalSettings*') || request()->is('*/admin/finance_calender*') || request()->is('*/admin/branches*') ||  request()->is('*/admin/departements*') || request()->is('*/admin/jobs_categories*')  || request()->is('*/admin/Qualifications*') ||request()->is('*/admin/occasions*') || request()->is('*/admin/Resignations*') || request()->is('*/admin/Nationalities*') || request()->is('*/admin/Religions*')|| request()->is('*/admin/VehicleType*')|| request()->is('*/admin/VehicleModel*') ) ? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('mycustom.setting_menue') }}
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(9)==true)
            <li class="nav-item">
              <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/generalSettings*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>
                  {{ __('mycustom.generalSettings') }}
                </p>
              </a>
            </li>
            @endif
            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(10)==true)
            <li class="nav-item">
              <a href="{{ route('finance_calender.index') }}" class="nav-link  {{ (request()->is('*/admin/finance_calender*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/finance_calender*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>
                  {{ __('mycustom.finance_calender') }}
                  </p>
              </a>
            </li>
            @endif --}}
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(11)==true)
            <li class="nav-item">
              <a href="{{ route('branches.index') }}" class="nav-link  {{ (request()->is('*/admin/branches*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/branches*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>  
                  Operating companies 
                  </p>
              </a>
            </li>
            @endif

           
            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(18)==true)
            <li class="nav-item">
              <a href="{{ route('departements.index') }}" class="nav-link  {{ (request()->is('*/admin/departements*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/departements*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>   
                  {{ __('mycustom.departements') }}  
                </p>
              </a>
            </li>
            @endif --}}

            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(19)==true)
            <li class="nav-item">
              <a href="{{ route('jobs_categories.index') }}" class="nav-link  {{ (request()->is('*/admin/jobs_categories*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/jobs_categories*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>   
                  {{ __('mycustom.jobs_categories') }} 
                  </p>
              </a>
            </li>
            @endif --}}


            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(20)==true)
            <li class="nav-item">
              <a href="{{ route('Qualifications.index') }}" class="nav-link  {{ (request()->is('*/admin/Qualifications*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/Qualifications*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p> 
                  {{ __('mycustom.qualifications') }} 
                    </p>
              </a>
            </li>
            @endif


            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(21)==true)
            <li class="nav-item">
              <a href="{{ route('occasions.index') }}" class="nav-link  {{ (request()->is('*/admin/occasions*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/occasions*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>    
                  {{ __('mycustom.occasions') }} 
                  </p>
              </a>
            </li>
            @endif --}}


            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(22)==true)
            <li class="nav-item">
              <a href="{{ route('Resignations.index') }}" class="nav-link  {{ (request()->is('*/admin/Resignations*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/Resignations*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>     
                  {{ __('mycustom.resignations') }} 
                  </p>
              </a>
            </li>
            @endif --}}


            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(23)==true)
            <li class="nav-item">
              <a href="{{ route('Nationalities.index') }}" class="nav-link  {{ (request()->is('*/admin/Nationalities*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/Nationalities*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>    
                  {{ __('mycustom.nationalities') }} 
                    </p>
              </a>
            </li>
            @endif


            {{-- @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(24)==true)
            <li class="nav-item">
              <a href="{{ route('Religions.index') }}" class="nav-link  {{ (request()->is('*/admin/Religions*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/Religions*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>  
                  {{ __('mycustom.religions') }}
                </p>
              </a>
            </li>
            @endif --}}


            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(24)==true)
            <li class="nav-item">
              <a href="{{ route('VehicleType.index') }}" class="nav-link  {{ (request()->is('*/admin/VehicleType*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/VehicleType*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>  
                  {{ __('mycustom.vehicle_type') }}
                </p>
              </a>
            </li>
            @endif
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue(24)==true)
            <li class="nav-item">
              <a href="{{ route('VehicleModel.index') }}" class="nav-link  {{ (request()->is('*/admin/VehicleModel*'))?'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/VehicleModel*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>  
                  {{ __('mycustom.vehicle_model') }}
                </p>
              </a>
            </li>
            @endif

          </ul>
        </li>
        @endif
        {{-- ============================================================(نهاية قائمة الضبط )================================ --}}
    
    
        {{-- ============================================================(بداية قائمة شئون الموظفين )================================ --}}
        @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(6)==true)
        <li class="nav-item has-treeview    {{ (request()->is('*/admin/HumanResource*')||request()->is('*/admin/GovernmentProcess*'))? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('*/admin/HumanResource*')||request()->is('*/admin/GovernmentProcess*'))? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('mycustom.human_resource') }}
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">


             <li class="nav-item">
                  <a href="{{ route('HumanResource.index') }}" class="nav-link {{ (request()->is('*/admin/HumanResource*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/HumanResource*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> {{ __('mycustom.drivers') }}</p>
                  </a>
                </li>

                {{-- <li class="nav-item">
                  <a href="{{ route('HumanResource.GovernmentProcess') }}" class="nav-link {{ (request()->is('*/admin/GovernmentProcess*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/GovernmentProcess*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p>Staff Functional_status</p>
                  </a>
                </li> --}}

              
              
                
               

          </ul>
          @endif
                  {{-- ============================================================(نهاية قائمة شئون الموظفين )================================ --}}
               
                  
        {{-- ============================================================(بداية قائمة التشغيل  )================================ --}}
        {{-- @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(18)==true)
        <li class="nav-item has-treeview    {{ (request()->is('*/admin/Operation*')||request()->is('*/admin/ReportDailyOperation*')||request()->is('*/admin/ReportMonthlyOperation*')||request()->is('*/admin/operationGovernmentProcess*'))? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('*/admin/Operation*')||request()->is('*/admin/ReportDailyOperation*')||request()->is('*/admin/ReportMonthlyOperation*')||request()->is('*/admin/operationGovernmentProcess*'))? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('mycustom.operation') }}
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">


             <li class="nav-item">
                  <a href="{{ route('Operation.index') }}" class="nav-link {{ (request()->is('*/admin/Operation*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/Operation*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> {{ __('mycustom.drivers') }}</p>
                  </a>
                </li>

             
                

                <li class="nav-item">
                  <a href="{{ route('Operation.index') }}" class="nav-link {{ (request()->is('*/admin/Salary*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/Salary*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> المرتبات</p>
                  </a>
                </li>

             
              
            
        

          </ul>
          @endif --}}
                  {{-- ============================================================(نهاية قائمة التشغيل  )================================ --}}
                        
               {{-- ============================================================(بداية قائمة الشئون المالية )================================ --}}
               @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(9)==true)
               <li class="nav-item has-treeview    {{ (request()->is('*/admin/financial*')||request()->is('*/admin/FinancialEmployees*')||request()->is('*/admin/FinancialGeneralLoans*')||request()->is('*/admin/FinancialSpecialLoans*'))? 'menu-open':'' }} ">
                <a href="#" class="nav-link {{ ( request()->is('*/admin/financial*')||request()->is('*/admin/FinancialEmployees*') ||request()->is('*/admin/FinancialGeneralLoans*')||request()->is('*/admin/FinancialSpecialLoans*') )? 'active':'' }} ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{ __('mycustom.financial') }}
                    @if (app()->getLocale()=='ar')
                    <i class="right fas fa-angle-left"></i>
                    @else
                    <i class="right fas fa-angle-left fa-rotate-180"></i>
                    @endif
                  </p>
                </a>
                <ul class="nav nav-treeview">
            
            
                   <li class="nav-item">
                        <a href="{{ route('financial.index') }}" class="nav-link {{ (request()->is('*/admin/financial*'))?'active':'' }}">
                          <i class="far nav-icon {{ (request()->is('*/admin/financial*'))?'fa-dot-circle':'fa-circle' }}"></i>
                          <p> {{ __('mycustom.drivers') }}</p>
                        </a>
                      </li>

                      {{-- <li class="nav-item">
                        <a href="{{ route('financial.employees') }}" class="nav-link {{ (request()->is('*/admin/FinancialEmployees*'))?'active':'' }}">
                          <i class="far nav-icon {{ (request()->is('*/admin/FinancialEmployees*'))?'fa-dot-circle':'fa-circle' }}"></i>
                          <p>موظفين الادارة</p>
                        </a>
                      </li> --}}
{{--             
                      <li class="nav-item">
                        <a href="{{ route('financial.generalLoans_index') }}" class="nav-link {{ (request()->is('*/admin/FinancialGeneralLoans*'))?'active':'' }}">
                          <i class="far nav-icon {{ (request()->is('*/admin/FinancialGeneralLoans*'))?'fa-dot-circle':'fa-circle' }}"></i>
                          <p> 
                            {{ __('mycustom.generalLoans') }}  
                          </p>
                        </a>
                      </li> --}}
            
                      <li class="nav-item">
                        <a href="{{ route('financial.specialLoans_index') }}" class="nav-link {{ (request()->is('*/admin/FinancialSpecialLoans*'))?'active':'' }}">
                          <i class="far nav-icon {{ (request()->is('*/admin/FinancialSpecialLoans*'))?'fa-dot-circle':'fa-circle' }}"></i>
                          <p>
                            {{ __('mycustom.specialLoans') }}  
                            </p>
                        </a>
                      </li>
            
                      
                     
            
                </ul>
                @endif

                        {{-- ============================================================(نهاية قائمة الشئون المالية )================================ --}}
     
        {{-- ============================================================(بداية قائمة حارس الأمن  )================================ --}}
        @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(16)==true)
        <li class="nav-item has-treeview    {{ (request()->is('*/admin/SecurityGuard_Receive*')||request()->is('*/admin/SecurityGuard_Return*')||request()->is('*/admin/SecurityGuard_violations*'))? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('*/admin/SecurityGuard_Receive*')||request()->is('*/admin/SecurityGuard_Return*')||request()->is('*/admin/SecurityGuard_violations*'))? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Security guard
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">


                <li class="nav-item">
                  <a href="{{ route('SecurityGuard_Receive.index') }}" class="nav-link {{ (request()->is('*/admin/SecurityGuard_Receive*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/SecurityGuard_Receive*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> Receiving deposits</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{ route('SecurityGuard.show_drivers_deposit') }}" class="nav-link {{ (request()->is('*/admin/SecurityGuard_Return*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/SecurityGuard_Return*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> Return deposits </p>
                  </a>
                </li>


                {{-- <li class="nav-item">
                  <a href="{{ route('SecurityGuard_violations.index') }}" class="nav-link {{ (request()->is('*/admin/SecurityGuard_violations*'))?'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/SecurityGuard_violations*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> packaging_W violations</p>
                  </a>
                </li>
              --}}
              
    

          </ul>
          @endif
                  {{-- ============================================================(نهاية قائمة حارس الأمن  )================================ --}}
     
                  {{-- ============================================================(بداية قائمة زي العمل  )================================ --}}
     @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(17)==true)
     <li class="nav-item has-treeview    {{ (request()->is('*/admin/uniform_Receive*')||request()->is('*/admin/uniform_Return*')||request()->is('*/admin/uniform_violations*'))? 'menu-open':'' }} ">
       <a href="#" class="nav-link {{ ( request()->is('*/admin/uniform_Receive*')||request()->is('*/admin/uniform_Return*')||request()->is('*/admin/uniform_violations*'))? 'active':'' }} ">
         <i class="nav-icon fas fa-tachometer-alt"></i>
         <p>
           Work uniform
           @if (app()->getLocale()=='ar')
           <i class="right fas fa-angle-left"></i>
           @else
           <i class="right fas fa-angle-left fa-rotate-180"></i>
           @endif
         </p>
       </a>
       <ul class="nav nav-treeview">


             <li class="nav-item">
               <a href="{{ route('uniform_Receive.index') }}" class="nav-link {{ (request()->is('*/admin/uniform_Receive*'))?'active':'' }}">
                 <i class="far nav-icon {{ (request()->is('*/admin/uniform_Receive*'))?'fa-dot-circle':'fa-circle' }}"></i>
                 <p> Receive work uniform</p>
               </a>
             </li>

             <li class="nav-item">
               <a href="{{ route('uniform.show_drivers_deposit') }}" class="nav-link {{ (request()->is('*/admin/uniform_Return*'))?'active':'' }}">
                 <i class="far nav-icon {{ (request()->is('*/admin/uniform_Return*'))?'fa-dot-circle':'fa-circle' }}"></i>
                 <p> Return of work uniform</p>
               </a>
             </li>


             {{-- <li class="nav-item">
               <a href="{{ route('uniform_violations.index') }}" class="nav-link {{ (request()->is('*/admin/uniform_violations*'))?'active':'' }}">
                 <i class="far nav-icon {{ (request()->is('*/admin/uniform_violations*'))?'fa-dot-circle':'fa-circle' }}"></i>
                 <p> uniform violations</p>
               </a>
             </li>
           --}}
           


       </ul>
       @endif
               {{-- ============================================================(نهاية قائمة حارس الأمن  )================================ --}}
 
               
                  {{-- ============================================================(بداية قائمة الشئون القانونية )================================ --}}
                  {{-- @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(8)==true)
                  <li class="nav-item has-treeview    {{ (request()->is('*/admin/TheLegal*')||request()->is('*/admin/TheLegal/employees*'))? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('*/admin/TheLegal*')||request()->is('*/admin/TheLegal/employees*') )? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('mycustom.Legal') }}
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">


       <li class="nav-item">
            <a href="{{ route('TheLegal.index') }}" class="nav-link {{ (request()->is('*/admin/TheLegal*'))?'active':'' }}">
              <i class="far nav-icon {{ (request()->is('*/admin/TheLegal*'))?'fa-dot-circle':'fa-circle' }}"></i>
              <p>{{ __('mycustom.Legal_drivers') }}</p>
            </a>
          </li>

    </ul>
    @endif --}}

            {{-- ============================================================(نهاية قائمة الشئون القانونية )================================ --}}
         
         
   

          

                      
                           {{-- ============================================================(بداية قائمة قسم الصيانه  )================================ --}}
                           @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(11)==true)
                           <li class="nav-item has-treeview    {{ (request()->is('*/admin/maintenanceCarDrivers*')||request()->is('*/admin/Maintenance*')||request()->is('*/admin/maintenanceBike*')||request()->is('*/admin/maintenanceTrafficViolations*')||request()->is('*/admin/maintenanceTrafficAccidents*'))? 'menu-open':'' }} ">
                      <a href="#" class="nav-link {{ ( request()->is('*/admin/maintenanceCarDrivers*')||request()->is('*/admin/Maintenance*')||request()->is('*/admin/maintenanceBike*') ||request()->is('*/admin/maintenanceTrafficViolations*')||request()->is('*/admin/maintenanceTrafficAccidents*') )? 'active':'' }} ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          {{ __('mycustom.maintenance') }}
                          @if (app()->getLocale()=='ar')
                          <i class="right fas fa-angle-left"></i>
                          @else
                          <i class="right fas fa-angle-left fa-rotate-180"></i>
                          @endif
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
          

                        <li class="nav-item">
                          <a href="{{ route('Maintenance.index_car_drivers') }}" class="nav-link {{ (request()->is('*/admin/maintenanceCarDrivers*'))?'active':'' }}">
                            <i class="far nav-icon {{ (request()->is('*/admin/maintenanceCarDrivers*'))?'fa-dot-circle':'fa-circle' }}"></i>
                            <p>
                              Car Drivers
                              </p>
                          </a>
                        </li>
          
                 <li class="nav-item">
                      <a href="{{ route('Maintenance.index') }}" class="nav-link {{ (request()->is('*/admin/Maintenance*'))?'active':'' }}">
                        <i class="far nav-icon {{ (request()->is('*/admin/Maintenance*'))?'fa-dot-circle':'fa-circle' }}"></i>
                        <p>
                          {{ __('mycustom.cars') }} 
                          </p>
                      </a>
                    </li>
          
                    <li class="nav-item">
                      <a href="{{ route('Maintenance.index_bike') }}" class="nav-link {{ (request()->is('*/admin/maintenanceBike*'))?'active':'' }}">
                        <i class="far nav-icon {{ (request()->is('*/admin/maintenanceBike*'))?'fa-dot-circle':'fa-circle' }}"></i>
                        <p> 
                          {{ __('mycustom.bike') }} 
                         </p>
                      </a>
                    </li>
          
                    <li class="nav-item">
                      <a href="{{ route('Maintenance.index_traffic_violations') }}" class="nav-link {{ (request()->is('*/admin/maintenanceTrafficViolations*'))?'active':'' }}">
                        <i class="far nav-icon {{ (request()->is('*/admin/maintenanceTrafficViolations*'))?'fa-dot-circle':'fa-circle' }}"></i>
                        <p>
                          {{ __('mycustom.traffic_violations') }}  
                          </p>
                      </a>
                    </li>


                    <li class="nav-item">
                      <a href="{{ route('Maintenance.index_traffic_accidents') }}" class="nav-link {{ (request()->is('*/admin/maintenanceTrafficAccidents*'))?'active':'' }}">
                        <i class="far nav-icon {{ (request()->is('*/admin/maintenanceTrafficAccidents*'))?'fa-dot-circle':'fa-circle' }}"></i>
                        <p>
                          {{ __('mycustom.traffic_accidents') }}  
                          </p>
                      </a>
                    </li>
                   
          
              </ul>
              @endif

                      {{-- ============================================================(نهاية قائمة قسم الصيانه )================================ --}}
                   
               {{-- ============================================================(بداية قسم السكن والاعاشة   )================================ --}}
               @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(12)==true)
               <li class="nav-item has-treeview    {{ (request()->is('*/admin/Housing*')||request()->is('*/admin/housingEmployess*')||request()->is('*/admin/housingFlats*'))? 'menu-open':'' }} ">
                <a href="#" class="nav-link {{ ( request()->is('*/admin/Housing*')||request()->is('*/admin/housingEmployess*') ||request()->is('*/admin/housingFlats*') )? 'active':'' }} ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    {{ __('mycustom.housing') }}  
                    @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
                  </p>
                </a>
                <ul class="nav nav-treeview">
            

                  <li class="nav-item">
                    <a href="{{ route('Housing.index') }}" class="nav-link {{ (request()->is('*/admin/Housing*'))?'active':'' }}">
                      <i class="far nav-icon {{ (request()->is('*/admin/Housing*'))?'fa-dot-circle':'fa-circle' }}"></i>
                      <p>{{ __('mycustom.drivers') }}</p>
                    </a>
                  </li>
            

                   <li class="nav-item">
                        <a href="{{ route('Housing.flats') }}" class="nav-link {{ (request()->is('*/admin/housingFlats*'))?'active':'' }}">
                          <i class="far nav-icon {{ (request()->is('*/admin/housingFlats*'))?'fa-dot-circle':'fa-circle' }}"></i>
                          <p>{{ __('mycustom.flats') }}</p>
                        </a>
                      </li>
            
                     
                      
                     
            
                </ul>
                @endif

                        {{-- ============================================================(نهاية   قسم السكن والاعاشة )================================ --}}
                     
     {{-- ============================================================(بداية قائمة  المدرسة   )================================ --}}
     {{-- @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(13)==true)
     <li class="nav-item has-treeview    {{ (request()->is('*/admin/School*'))? 'menu-open':'' }} ">
      <a href="#" class="nav-link {{ ( request()->is('*/admin/School*'))? 'active':'' }} ">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          {{ __('mycustom.school') }}  
          @if (app()->getLocale()=='ar')
    <i class="right fas fa-angle-left"></i>
    @else
    <i class="right fas fa-angle-left fa-rotate-180"></i>
    @endif
        </p>
      </a>
      <ul class="nav nav-treeview">
  

        <li class="nav-item">
          <a href="{{ route('School.index') }}" class="nav-link {{ (request()->is('*/admin/School*'))?'active':'' }}">
            <i class="far nav-icon {{ (request()->is('*/admin/School*'))?'fa-dot-circle':'fa-circle' }}"></i>
            <p> {{ __('mycustom.driver_information') }}</p>
          </a>
        </li>
     
  
      </ul>
      @endif --}}
              {{-- ============================================================(نهاية قائمة المدرسة  )================================ --}}
        
{{-- ============================================================(بداية قائمة  الجودة   )================================ --}}
@if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(15)==true)
<li class="nav-item has-treeview    {{ (request()->is('*/admin/Quality*')|| request()->is('*/admin/AdministrativeQuality*')|| request()->is('*/admin/AdministrativeComplaints*')|| request()->is('*/admin/ShowDailyReport*')||request()->is('*/admin/ShowDailyDrivingReport*')||request()->is('*/admin/QualityMyCalendarIndex*')||request()->is('*/admin/subjects*')||request()->is('*/admin/QualityimportAttendenceIndex*')|| request()->is('*/admin/ShiftsTypes*'))? 'menu-open':'' }} ">
 <a href="#" class="nav-link {{ ( request()->is('*/admin/Quality*')|| request()->is('*/admin/AdministrativeQuality*')|| request()->is('*/admin/AdministrativeComplaints*') || request()->is('*/admin/ShowDailyReport*')||request()->is('*/admin/ShowDailyDrivingReport*')||request()->is('*/admin/QualityMyCalendarIndex*')||request()->is('*/admin/subjects*')||request()->is('*/admin/QualityimportAttendenceIndex*')|| request()->is('*/admin/ShiftsTypes*'))? 'active':'' }} ">
   <i class="nav-icon fas fa-tachometer-alt"></i>
   <p>
     {{ __('mycustom.quality') }}  
     @if (app()->getLocale()=='ar')
<i class="right fas fa-angle-left"></i>
@else
<i class="right fas fa-angle-left fa-rotate-180"></i>
@endif
   </p>
 </a>
 <ul class="nav nav-treeview">



  <li class="nav-item">
    <a href="{{ route('Quality.administrativeComplaints') }}" class="nav-link {{ (request()->is('*/admin/AdministrativeComplaints*'))?'active':'' }}">
      <i class="far nav-icon {{ (request()->is('*/admin/AdministrativeComplaints*'))?'fa-dot-circle':'fa-circle' }}"></i>
      <p>AdministrativeComplaints</p>
    </a>
  </li>


   <li class="nav-item">
    <a href="{{ route('DailyReport.show_daily_report') }}" class="nav-link {{ (request()->is('*/admin/ShowDailyReport*'))?'active':'' }}">
      <i class="far nav-icon {{ (request()->is('*/admin/ShowDailyReport*'))?'fa-dot-circle':'fa-circle' }}"></i>
      <p>
        {{ __('mycustom.daily_report') }}  
      </p>
    </a>
  </li>

 



 </ul>
 @endif
         {{-- ============================================================(نهاية قائمة الجودة  )================================ --}}


 {{-- ============================================================(بداية  قائمة الإعدادات   )================================ --}}
 <li class="nav-item has-treeview    {{ (request()->is('*/admin/userProfile*')||request()->is('*/admin/DailyReport*')||request()->is('*/admin/DailyDrivingReport*')||request()->is('*/admin/AdministrativeSendComplaints*')||request()->is('*/admin/logout'))? 'menu-open':'' }} ">
  <a href="#" class="nav-link {{ ( request()->is('*/admin/userProfile*')||request()->is('*/admin/DailyReport*')||request()->is('*/admin/DailyDrivingReport*')||request()->is('*/admin/AdministrativeSendComplaints*')||request()->is('*/admin/logout'))? 'active':'' }} ">
    <i class="nav-icon fas fa-tachometer-alt"></i>
    <p>
      {{ __('mycustom.setting') }}    
      @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
    </p>
  </a>
  <ul class="nav nav-treeview">


     <li class="nav-item">
          <a href="{{ route('userProfile.index') }}" class="nav-link {{ (request()->is('*/admin/userProfile*'))?'active':'' }}">
            <i class="far nav-icon {{ (request()->is('*/admin/userProfile*'))?'fa-dot-circle':'fa-circle' }}"></i>
            <p> 
              {{ __('mycustom.profile') }}  
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('DailyReport.index') }}" class="nav-link {{ (request()->is('*/admin/DailyReport*'))?'active':'' }}">
            <i class="far nav-icon {{ (request()->is('*/admin/DailyReport*'))?'fa-dot-circle':'fa-circle' }}"></i>
            <p> 
              {{ __('mycustom.daily_report') }}  
            </p>
          </a>
        </li>

     
        <li class="nav-item">
          <a href="{{ route('Quality.administrativeSendComplaintsCreate') }}" class="nav-link {{ (request()->is('*/admin/AdministrativeSendComplaints*'))?'active':'' }}">
            <i class="far nav-icon {{ (request()->is('*/admin/AdministrativeSendComplaints*'))?'fa-dot-circle':'fa-circle' }}"></i>
            <p>Submit a complaint</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="{{ route('admin.logout') }}" class="nav-link {{ (request()->is('*/admin/logout'))?'active':'' }}">
            <i class="far nav-icon {{ (request()->is('*/admin/logout'))?'fa-dot-circle':'fa-circle' }}"></i>
            <p>
              {{ __('mycustom.logout') }}  
              </p>
          </a>
        </li>
       

  </ul>
 {{-- ============================================================(نهاية  قائمة الإعدادات   )================================ --}}

       








          {{-- ============================================================(بداية قائمة الادوار والصلاحيات  )================================ --}}
          @if (auth()->user()->is_master_Admin==1 || check_permission_main_menue(7)==true)
        <li class="nav-item has-treeview    {{ (request()->is('*/admin/permission_roles*')||request()->is('*/admin/permission_main_menues*')||request()->is('*/admin/permission_sub_menues*')||request()->is('*/admin/admins_accounts*'))? 'menu-open':'' }} ">
          <a href="#" class="nav-link {{ ( request()->is('*/admin/permission_roles*')||request()->is('*/admin/permission_main_menues*') ||request()->is('*/admin/permission_sub_menues*')||request()->is('*/admin/admins_accounts*') )? 'active':'' }} ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('mycustom.permission_roles') }}   
              @if (app()->getLocale()=='ar')
              <i class="right fas fa-angle-left"></i>
              @else
              <i class="right fas fa-angle-left fa-rotate-180"></i>
              @endif
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admins_accounts.index') }}" class="nav-link {{ (request()->is('*/admin/admins_accounts*'))? 'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/admins_accounts*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p>المستخدمين</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('permission_roles.index') }}" class="nav-link {{ (request()->is('*/admin/permission_roles*'))? 'active':'' }}">
                <i class="far nav-icon {{ (request()->is('*/admin/permission_roles*'))?'fa-dot-circle':'fa-circle' }}"></i>
                <p> ادوار المستخدمين</p>
              </a>
            </li>

              <li class="nav-item">
                <a href="{{ route('permission_main_menues.index') }}" class="nav-link {{ (request()->is('*/admin/permission_main_menues*'))? 'active':'' }}">
                  <i class="far nav-icon {{ (request()->is('*/admin/permission_main_menues*'))?'fa-dot-circle':'fa-circle' }}"></i>
                  <p> القوائم الرئيسية للصلاحيات </p>
                </a>
              </li>

                <li class="nav-item">
                  <a href="{{ route('permission_sub_menues.index') }}" class="nav-link {{ (request()->is('*/admin/permission_sub_menues*'))? 'active':'' }}">
                    <i class="far nav-icon {{ (request()->is('*/admin/permission_sub_menues*'))?'fa-dot-circle':'fa-circle' }}"></i>
                    <p> القوائم الفرعية للصلاحيات </p>
                  </a>
                </li>

          </ul>
          @endif

           {{-- ============================================================(نهاية قائمة الادوار والصلاحيات  )================================ --}}
          

            {{-- <li class="nav-item has-treeview    {{ ( request()->is('*/admin/Employees*'))? 'menu-open':'' }} ">
              <a href="#" class="nav-link {{ ( request()->is('*/admin/Employees*'))? 'active':'' }} ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                 قائمة شئون الموظفين
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              
                <li class="nav-item">
                  <a href="{{ route('Employees.index') }}" class="nav-link {{ (request()->is('*/admin/Employees*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> بيانات الموظفين</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> بيانات موظفين الادارة</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> انواع الاضافي للراتب</p>
                  </a>
                </li>
    
                <li class="nav-item">
                  <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> انواع الخصم للراتب</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p> انواع البدلات للراتب</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin_panel_settings.index') }}" class="nav-link {{ (request()->is('*/admin/generalSettings*'))?'active':'' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>   هواتف الموظفين</p>
                  </a>
                </li>
     --}}
       
    
        


       
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>