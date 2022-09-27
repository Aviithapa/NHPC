
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="image text-center">
                {{-- <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image" /> --}}
            </div>
            <div class="info">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu -->
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">PERSONAL</li>
            <li class="{{ (request()->is('council/dashboard')) ? 'active':''  }}">
                <a href="{{route('council.dashboard')}}">
                    <i class="icon-home"></i> <span>Dashboard</span>

                </a>
            </li>
            <li class="{{ (request()->is('council/dashboard/council/applicant/passed/list')) ? 'active':''  }}">
                <a href="{{route("council.pass.list")}}">
                    <i class="icon-graduation"></i> <span>View all Passed List</span>
                </a>
            </li>
            <li class="{{ (request()->is('council/dashboard/council/applicant/tslc/list')) ? 'active':''  }}">
                <a href="{{route("council.tslc.list")}}">
                    <i class="icon-graduation"></i> <span>View TSLC Student List</span>
                </a>
            </li>
            <li class="{{ (request()->is('council/dashboard/council/darta/book')) ? 'active':  ''  }}">
                <a href="{{route('council.darta.book')}}">
                    <i class="icon-book-open"></i> <span>Darta Book</span>

                </a>
            </li>
            <li class="{{ (request()->is('council/dashboard/officer/subjectCommittee/minuteIndex')) ? 'active':''  }}">
                <a href="{{route("subjectCommittee.minuteDataSubjectCommitteeIndex.officer")}}">
                    <i class="icon-book-open"></i> <span>Minute  Committee Data</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
