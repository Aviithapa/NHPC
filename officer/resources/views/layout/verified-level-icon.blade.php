@if($profile_processing)

@if($profile_processing->current_state === 'officer')
    <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Operator Accepted</p>
            </div>
        </div>
    </li>

@elseif($profile_processing->current_state === 'registrar')
    <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Operator Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Officer Accepted</p>
            </div>
        </div>
    </li>
@elseif($profile_processing->current_state === 'subject_committee')
    <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Operator Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Officer Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Registrar Accpeted</p>
            </div>
        </div>
    </li>
@elseif($profile_processing->current_state === 'exam_committee')
    <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Operator Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Officer Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Registrar Accpeted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Subject Committee Accepted</p>
            </div>
        </div>
    </li>
@elseif($profile_processing->current_state === 'council')
    @if($profile_processing->status === 'accepted')
        <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Operator Accepted</p>
                </div>
            </div>
        </li>
        <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Officer Accepted</p>
                </div>
            </div>
        </li>
        <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Registrar Accpeted</p>
                </div>
            </div>
        </li>
        <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Subject Committee Accepted</p>
                </div>
            </div>
        </li>

        <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Exam Committee Accepeted</p>
                </div>
            </div>
        </li>
        <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
                <a href="#">
                    <i class="fa fa-star fa-2x"></i>
                </a>
                <div class="popover__content">
                    <p class="popover__message">Council Accepeted</p>
                </div>
            </div>
        </li>
        @else
    <li class="nav-item" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Operator Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Officer Accepted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Registrar Accpeted</p>
            </div>
        </div>
    </li>
    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Subject Committee Accepted</p>
            </div>
        </div>
    </li>

    <li class="nav-item ml-1" style="color: #2596be;"><div class="popover__wrapper">
            <a href="#">
                <i class="fa fa-star fa-2x"></i>
            </a>
            <div class="popover__content">
                <p class="popover__message">Exam Committee Accepeted</p>
            </div>
        </div>
    </li>
    @endif
@else

@endif
@endif
