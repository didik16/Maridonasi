


<p>Hallo, {{ Auth::user()->name }}. Apakabar?</p>

  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>