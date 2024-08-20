

<nav class="navbar navbar-expand-md navbar-light bg-secondary text-white navbar-laravel">
            <div class="container">
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    {{ config('app.name', 'Smart Work') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto pl-5 ml-5">
                        @auth
                            @if (Auth::user()->user_role->RoleName === "Librarian")
                                <li class="nav-item">
                                    <a href="{{route('staff.index')}}" class="nav-link text-white">USERS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('library.index')}}" class="nav-link text-white">PUBLIC FOLDER</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teachers.index')}}" class="nav-link text-white">TEACHERS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('students.index')}}" class="nav-link text-white">STUDENTS</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        BOOKS<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link" href="{{ route('books.index') }}">
                                            {{ __('VIEW ALL') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('book-types.index') }}">
                                            {{ __('BOOK CATEGORIES') }}
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        SYSTEM SETTINGS<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link" href="{{ route('schools.index') }}">
                                            {{ __('SCHOOLS') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('classes.index') }}">
                                            {{ __('CLASSES') }}
                                        </a>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->user_role->RoleName === 'Administrator')
                            {{-- Nav bar list Items accessed by Admin only --}}
                                <li class="nav-item">
                                    <a href="{{route('staff.index')}}" class="nav-link text-white">USERS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('library.index')}}" class="nav-link text-white">PUBLIC FOLDER</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('schools.index')}}" class="nav-link text-white">SCHOOLS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teachers.index')}}" class="nav-link text-white">TEACHERS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('students.index')}}" class="nav-link text-white">STUDENTS</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        BOOKS<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link" href="{{ route('books.index') }}">
                                            {{ __('VIEW ALL') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('book-types.index') }}">
                                            {{ __('BOOK CATEGORIES') }}
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        SYSTEM SETTINGS<span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item nav-link" href="{{ route('classes.index') }}">
                                            {{ __('CLASSES') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('departments.index') }}">
                                            {{ __('DEPARTMENTS') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('user-roles.index') }}">
                                            {{ __('USER ROLES') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('titles.index') }}">
                                            {{ __('USER TITLES') }}
                                        </a>
                                    </div>
                                </li>
                            @endif


                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Auth::guard('other_user')->user())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('other_user')->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.changePassword') }}">{{ __('Change Password') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->FirstName.' '.Auth::user()->SecondName }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.changePassword') }}">{{ __('Change Password') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
