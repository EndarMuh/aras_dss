                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="https://www.linkedin.com/company/lintang-utama-infotek/">BRAVO of LUI</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">LUI</a>
                    </div>
                    <ul class="sidebar-menu">
                        @section('sidebar')
                            <li class="menu-header">Main</li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-bars"></i><span>Menu Utama</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-users"></i><span>Karyawan</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}" class="nav-link"><i class="fas fa-star"></i><span>Monthly Awardee</span></a>
                            </li>
                    </ul>
                </aside>
