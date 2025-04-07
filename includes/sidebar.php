<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?php echo BASE_URL; ?>index.php"> <img alt="image" src="<?php echo BASE_URL; ?>assets/img/logo.png" class="header-logo" /> <span
                    class="logo-name">Small CRM</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>association.php" class="nav-link"><i data-feather="box"></i><span>Association</span></a>
            </li>
            <li class="menu-header">Employees</li>
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>departments.php" class="nav-link"><i data-feather="briefcase"></i><span>Departments</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>employee_position.php" class="nav-link"><i data-feather="archive"></i><span>Position</span></a>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Employees</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_employee.php">Add</a></li>
                    <li><a class="nav-link" href="employees.php">Show</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>retiring_employee.php" class="nav-link"><i data-feather="user-minus"></i><span>Retired Employee</span></a>
            </li>
            <li class="menu-header">Leave</li>
            <!-- <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="users"></i><span>Leave </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="add_employee.php">Add</a></li>
                    <li><a class="nav-link" href="employees.php">Show</a></li>
                </ul>
            </li> -->
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>leave_category.php" class="nav-link"><i data-feather="archive"></i><span>Leave Category</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php echo BASE_URL; ?>leave_manage.php" class="nav-link"><i data-feather="archive"></i><span>Leaves</span></a>
            </li>
            <li class="menu-header">Time Tracking</li>
            <li class="dropdown">
                <a href="<?php //echo BASE_URL; 
                            ?>#" class="nav-link"><i data-feather="clock"></i><span>Hours Settings</span></a>
            </li>
            <li class="dropdown">
                <a href="<?php //echo BASE_URL; 
                            ?>#" class="nav-link"><i data-feather="info"></i><span>Check In/Check Out</span></a>
            </li>

        </ul>
    </aside>
</div>