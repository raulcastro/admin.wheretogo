<?php
/**
 * This file has the main view of the project
 *
 * @package    Reservation System
 * @subpackage Tropical Casa Blanca Hotel
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Raul Castro <rd.castro.silva@gmail.com>
 */

$root = $_SERVER['DOCUMENT_ROOT'];
/**
 * Includes the file /Framework/Tools.php which contains a 
 * serie of useful snippets used along the code
 */
require_once $root.'/Framework/Tools.php';

/**
 * 
 * Is the main class, almost everything is printed from here
 * 
 * @package 	Elite M Group
 * @subpackage 	Elite M Group - Admin section
 * @author 		Raul Castro <rd.castro.silva@gmail.com>
 * 
 */
class Layout_View
{
	/**
	 * @property string $data a big array cotaining info for especified sections
	 */
	private $data;
	
	/**
	 * get's the data *ARRAY* and the title of the document
	 * 
	 * @param array $data Is a big array with the whole info of the document 
	 * @param string $title The title that will be printed in <title></title>
	 */
	public function __construct($data)
	{
		$this->data = $data;
	}
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param int $this->data['section'] the section that define what will be printed
	 * 
	 */
	
	public function printHTMLPage()
    {
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
			<meta charset="utf-8" />
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
    		<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<title><?php echo $this->data['title']; ?> - <?php echo $this->data['appInfo']['title']; ?></title>
			<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
			<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
			<meta property="og:type" content="website" /> 
			<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
			<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
			<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
			<?php echo self::getCommonStyleDocuments(); ?>			
			<?php 
			switch ($this->data['section']) 
			{
				case 'log-in':
 					echo self::getLogInHead();
				break;

				case 'add-company':
					echo self::getAddCompanyHead();
					break;
					
				case 'dashboard':
					# code...
					break;
					
				case 'main-gallery':
					echo self::getMainGalleryHead();
					break;
					
				case 'edit-company':
					echo self::getEditCompanyHead();
					break;
					
				case 'videos':
					echo self::getMainVideosHead();
					break;
					
				case 'settings':
					echo self::getSettingsHead();
					break;
			}
			?>
		</head>
		<body id="<?php echo $this->data['section']; ?>" class="hold-transition <?php echo $this->data['template-class']; ?> fixed  skin-blue sidebar-mini">
			<?php 
			if ($this->data['section'] != 'log-in' && $this->data['section'] != 'log-out' && $this->data['section'] != 'unauthorized-page')
			{
			?>
			<div class="wrapper">
				<?php echo self :: getHeader(); ?>
				<?php echo self :: getSidebar(); ?>
				
				<!-- Content Wrapper. Contains page content -->
		        <div class="content-wrapper">
		            <!-- Content Header (Page header) -->
		            <section class="content-header">
		                <h1><?php echo $this->data['title']; ?></h1>
		                <ol class="breadcrumb">
		                    <li><a href="#"><i class="fa <?php echo $this->data['icon']; ?>"></i><?php echo $this->data['title']; ?></a></li>
		                    <!-- <li class="active">Here</li> -->
		                </ol>
		            </section>
		            <!-- Main content -->
            			<section class="content">
						<?php 
						switch ($this->data['section']) {

							case 'dashboard':
								echo self::getGridContent();
								break;
								
							case 'add-company':
								echo self::getAddCompanyContent();
								break;
								
							case 'edit-company':
								echo self::getEditCompanyContent();
								break;
								
							case 'main-gallery':
								echo self::getMainGalleryContent();
								break;
								
							case 'videos':
								echo self::getMainVideosContent();
								break;
								
							case 'settings':
								echo self::getSettingsContent();
								break;
						}
						?>
					</section>
				</div>
			</div>
			<?php
				echo self::getFooter();
			}
			else
			{
				switch ($this->data['section']) 
				{
					case 'log-in':
						echo self::getLogInContent();
					break;
					
					case 'unauthorized-page':
						echo self::getUnAuthorized();
					break;
				
					case 'log-out':
						echo self::getSignOutContent();
					break;
					
					default:
					break;
				}
			}
			
			echo self::getCommonScriptDocuments();
			
			switch ($this->data['section'])
			{
				case 'log-in':
					echo self::getLogInScripts();
					break;
					
				case 'add-company':
					echo self::getAddCompanyScripts();
					break;
					
				case 'main-gallery':
					echo self::getMainGalleryScripts();
					break;
					
				case 'edit-company':
					echo self::getEditCompanyScripts();
					break;
					
				case 'videos':
					echo self::getMainVideosScripts();
					break;
					
				case 'settings':
					echo self::getSettingsScripts();
					break;
			}
			?>
		</body>
	</html>
    <?php
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     */
    public function getCommonStyleDocuments()
    {
	    	ob_start();
	    	?>
	    <!-- Bootstrap 3.3.6 -->
	    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	    <!-- Font Awesome -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	    <!-- Ionicons -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	    <!-- Theme style -->
	    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
	    <!-- iCheck -->
	    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
	    
	    <link rel="stylesheet" href="/dist/css/skins/skin-blue.min.css">
       	<link href="/dist/css/Custom.css" media="screen" rel="stylesheet" type="text/css" />
	
	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  	<![endif]-->
    	
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * returns the common css and js that are in all the web documents
     * 
     * @return string $documents css & js files used in all the files
     * 
     */
    public function getCommonScriptDocuments()
    {
	    	ob_start();
	    	?>
	    <!-- jQuery 2.2.3 -->
	    <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
	    <!-- Bootstrap 3.3.6 -->
	    <script src="/bootstrap/js/bootstrap.min.js"></script>
	    <!-- AdminLTE App -->
    		<script src="/dist/js/app.min.js"></script>
    		<!-- SlimScroll -->
    		<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	    <!-- iCheck -->
	    <script src="/plugins/iCheck/icheck.min.js"></script>
	    <!-- bootBox -->
	    
	    <script src="/plugins/bootbox/bootbox.min.js"></script>
	    <script>
	        $(function() {
	            $('input').iCheck({
	                checkboxClass: 'icheckbox_square-blue',
	                radioClass: 'iradio_square-blue',
	                increaseArea: '20%' // optional
	            });
	        });
	
	    </script>
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * The main menu
     *
     * it's the top and main navigation menu
     * if is logged shows a sign-in | sign-up links
     * but if is logged it shows other menus included the sign-out
     *
     * @return string HTML Code of the main menu 
     * @TODO: WHERETOGO: Work with the log-out file?
     */
    public function getHeader()
    {
    	ob_start();
    	$active='class="active"';
    	?>  		
		<!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><?php echo $this->data['appInfo']['siteName']; ?></b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><?php echo $this->data['appInfo']['siteName']; ?></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-envelope-o"></i>
								<span class="label label-success">4</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 4 <?php echo _("messages"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- start message -->
											<a href="#">
												<div class="pull-left">
													<img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
												</div>
												<h4>
													Support Team
													<small><i class="fa fa-clock-o"></i> 5 mins</small>
												</h4>
												<p>mensaje de ejemplo ...</p>
											</a>
										</li>
										<!-- end message -->
									</ul>
								</li>
								<li class="footer"><a href="#"><?php echo _("See All Messages"); ?></a></li>
							</ul>
						</li>
						<!-- Notifications: style can be found in dropdown.less -->
						<li class="dropdown notifications-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-bell-o"></i>
								<span class="label label-warning">10</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 10 <?php echo _("notifications"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li>
											<a href="#">
												<i class="fa fa-users text-aqua"></i> 5 new members joined today
											</a>
										</li>
									</ul>
								</li>
								<li class="footer"><a href="#"><?php echo _("View all"); ?></a></li>
							</ul>
						</li>
						<!-- Tasks: style can be found in dropdown.less -->
						<li class="dropdown tasks-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-flag-o"></i>
								<span class="label label-danger">9</span>
							</a>
							<ul class="dropdown-menu">
								<li class="header"><?php echo _("You have"); ?> 9 <?php echo _("tasks"); ?></li>
								<li>
									<!-- inner menu: contains the actual data -->
									<ul class="menu">
										<li><!-- Task item -->
											<a href="#">
												<h3>
													Design some buttons
													<small class="pull-right">20%</small>
												</h3>
												<div class="progress xs">
													<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
														<span class="sr-only">20% Complete</span>
													</div>
												</div>
											</a>
										</li>
										<!-- end task item -->
									</ul>
								</li>
								<li class="footer">
								<a href="#"><?php echo _("View all tasks"); ?></a>
								</li>
							</ul>
						</li>                    
                    
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="https://graph.facebook.com/<?php echo $this->data['userInfo']['fb_id']; ?>/picture" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo $this->data['userInfo']['name']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="https://graph.facebook.com/<?php echo $this->data['userInfo']['fb_id']; ?>/picture?type=normal" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $this->data['userInfo']['name']; ?> - Administrator
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                	<div class="pull-left">
                  						<a href="#" class="btn btn-default btn-flat"><?php echo _("Profile"); ?></a>
                					</div>
                                    <div class="pull-right">
                                        <a href="/logout.php" class="btn btn-default btn-flat"><?php echo _("Sign Out"); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
							<a href="/settings/" ><i class="fa fa-gears"></i></a>
						</li>
                    </ul>
                </div>
            </nav>
        </header>
    	<?php
    	$header = ob_get_contents();
    	ob_end_clean();
    	return $header;
    }
    
    /**
     * it is the head that works for the sign in section, aparently isn't getting 
     * any parameter, I just left it here for future cases
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     * @todo 		Delete it?
     * 
     * @return string
     */
    public function getLogInHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    public function getLogInScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src="/js/log-in.js"></script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    /**
     * getSignInContent
     * 
     * the sign-in box
     * 
     * @package Reservation System
     * @subpackage Sign-in
     * 
     * @return string
     */
    public function getLogInContent()
    {
	    	ob_start();
	    	?>
		<div class="login-box">
			<div class="login-logo">
				<a href="/"><b>Where To Go</b> Admin</a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg">Sign in to start your session</p>
				<div class="social-auth-links text-center">
					<a href="/fbconfig.php" class="btn btn-block btn-social btn-facebook btn-flat">
						<i class="fa fa-facebook"></i> Log-In using Facebook
					</a>
				</div>
				<!-- /.social-auth-links -->
				<a href="#">I forgot my password</a><br>
				<a href="#" class="text-center">Register a new membership</a>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getSignInContent
     *
     * the sign-in box
     *
     * @package Reservation System
     * @subpackage Sign-in
     *
     * @return string
     */
    public function getUnAuthorized()
    {
	    	ob_start();
	    	?>
		<div class="login-box">
			<div class="login-logo">
				<a href="/"><b>Where To Go</b> Admin</a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<h4>You are not authorized to see this content</h4>
			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getSignOutContent
     *
     * It finish the session
     *
     * @package 	Reservation System
     * @subpackage 	Sign-in
     *
     * @return string
     */
    public function getSignOutContent()
    {
    	ob_start();
    	?>
       	<div class="row login-box" id="sign-in">
    		<div class="col-md-4 col-md-offset-4">
    			<h3 class="text-center">You've been logged out successfully</h3>
    			<br />
    	    	<div class="panel panel-default">
					<div class="panel-body">
						<a href="/" class="btn btn-lg btn-success btn-block">Login</a>
					</div>
    			</div>
    		</div>
    	</div>
		<?php
		$wideBody = ob_get_contents();
		ob_end_clean();
		return $wideBody;
    }
   	
    /**
     * The side bar of the apliccation
     * 
     * Is the side-bar of the application where the main sections are as links
     * 
     * @return string
     * 
     */
   	public function getSidebar()
   	{
   		ob_start();
   		$active = 'class="active"';
   		?>
   		<!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="https://graph.facebook.com/<?php echo $this->data['userInfo']['fb_id']; ?>/picture?type=normal" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $this->data['userInfo']['name']; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-lock text-info"></i> Administrator</a>
                    </div>
                </div>
				<!-- search form -->
<!-- 				<form action="#" method="get" class="sidebar-form"> -->
<!-- 					<div class="input-group"> -->
						<!-- <input type="text" name="q" class="form-control" placeholder="<?php echo _("Search"); ?> ..."> -->
<!-- 						<span class="input-group-btn"> -->
<!-- 							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button> -->
<!-- 						</span> -->
<!-- 					</div> -->
<!-- 				</form> -->
				<!-- /.search form -->
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header"><?php echo _("MAIN NAVIGATION"); ?></li>
                    <li class="active"><a href="/"><i class="fa fa-dashboard"></i> <span><?php echo _("Dashboard"); ?></span></a></li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa  fa-bank"></i>
                            <span><?php echo _("Companies"); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"><?php echo $this->data['nCompanies']; ?></small>
							</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/admin/add-company/"><i class="fa fa-plus-square"></i> <?php echo _("Add company"); ?></a></li>
                            <li><a href="/"><i class="fa fa-tag"></i> All</a></li>
                            <?php
		   				    foreach ($this->data['categories'] as $c)
		   				    {
		   				    ?>
		   			        <li>
		   						<a href="/grid/category/<?php echo $c['category_id']; ?>/<?php echo Tools::slugify($c['name']); ?>/">
		   							<i class="fa  fa-tag"></i>
		   							<?php echo $c['name']; ?>
		   						</a>
		   					</li>
		   				    <?php
		   				    }
		   				    ?>
                        </ul>
                    </li>
                    
                    <li>
						<a href="/grid/promoted/">
						<i class="fa fa-star"></i> <span>Main Promoted</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-blue"><?php echo $this->data['nPromoted']; ?></small>
							</span>
						</a>
					</li>
					
					<li>
						<a href="/grid/published/">
						<i class="fa fa-ban"></i> <span>Published</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"><?php echo $this->data['nPublished']; ?></small>
							</span>
						</a>
					</li>
					
					<li>
						<a href="/grid/unpublished/">
						<i class="fa fa-ban"></i> <span>Unpublished</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-red"><?php echo $this->data['nNoPublish']; ?></small>
							</span>
						</a>
					</li>
					
					<li>
						<a href="/grid/archived/">
						<i class="fa fa-ban"></i> <span>Archived</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-red"><?php echo $this->data['nNoArchived']; ?></small>
							</span>
						</a>
					</li>
                    <!-- 
                    <li>
						<a href="calendar.html">
							<i class="fa fa-calendar"></i> <span>Events</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-gray">17</small>
							</span>
						</a>
					</li>
					 -->
					<li class="treeview">
                        <a href="#">
                            <i class="fa fa-map"></i>
                            <span><?php echo _("Locations"); ?></span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <?php
		   				    foreach ($this->data['locations'] as $c)
		   				    {
		   				    ?>
		   			        <li>
		   						<a href="/grid/location/<?php echo $c['location_id']; ?>/<?php echo Tools::slugify($c['name']); ?>/">
		   							<i class="fa fa-map-pin"></i>
		   							<?php echo $c['name']; ?>
		   						</a>
		   					</li>
		   				    <?php
		   				    }
		   				    ?>
                        </ul>
                    </li>
					
					<li>
						<a href="/maingallery/">
							<i class="fa fa-file-photo-o"></i> <span>Main Gallery</span>
						</a>
					</li>
					<!-- 
					<li>
						<a href="/admin/main-videos/">
							<i class="fa  fa-video-camera"></i> <span>Videos</span>
						</a>
					</li>
                     -->
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
   		<?php
   		$sideBar = ob_get_contents();
   		ob_end_clean();
   		return $sideBar;
   	}
   	
   	/**
   	 * the big icons that appear on the top of every section
   	 * 
   	 * @return string
   	 */
   	public function getDashboardIcons() 
   	{
   		ob_start();
   		?>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Owners</span>
						<span class="info-box-number"><?php echo $this->data['totalMembers']; ?></span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Tasks</span>
						<span class="info-box-number"><?php echo $this->data['taskInfo']['today']; ?></span>
						<span class="progress-description"><?php echo $this->data['taskInfo']['pending']; ?> pending</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Messages</span>
						<span class="info-box-number">4</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
			
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="info-box">
                	<span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                	<div class="info-box-content">
						<span class="info-box-text">Payments</span>
						<span class="info-box-number">2</span>
					</div><!-- /.info-box-content -->
				</div><!-- /.info-box -->
			</div><!-- /.col -->
		</div>
          <!-- =========================================================== -->
   		<?php
   		$dashboardIcons = ob_get_contents();
   		ob_end_clean();
   		return $dashboardIcons;
   	}
   	
   	/**
   	 * getGridContent
   	 * it returns the structure of the grid
   	 * @return string
   	 */
   	public function getGridContent()
   	{
   		ob_start();
   		?>
    		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
				echo self::getGrid();
			?>
		</section>
    	<?php
    	$grid = ob_get_contents();
    	ob_end_clean();
    	return $grid;
    }
   	
    /**
     * getGrid
     *
     *The grid of all the companies, it doesn't matter if it's published or not
     * @return string
     * @TODO: WHERETOGO: change link color of the company title on the grid
     */
    public function getGrid()
    {
	    	ob_start();
	    	?>
   		<div id="main-grid" class='row'>
   			<?php 
   			if ($_GET['hasPromoted']) :
   			?>
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#allCompanies" data-toggle="tab">All</a></li>
						<li><a href="#promotedCompanies" data-toggle="tab">Promoted</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="allCompanies">
							<div class="row">
								<?php
						   		foreach ($this->data['companies'] as $a)
						   		{
						   			$logo = "";
						   			if ($a['logo'])
									{
										$logo = "/media/companies/logo/".$a['logo'];
									}
									else {
										$logo = "/dist/img/default/companies/logo/logo.jpg";
									}
								?>
									<div class='col-lg-3 col-md-6 company-item'>
										<div class="box box-primary">
											<div class="box-body box-profile">
												<a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><img class="profile-user-img img-responsive" src="<?php echo $logo; ?>" alt="User profile picture"></a>
												<h3 class="profile-username text-center"><a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><?php echo $a['name']; ?></a></h3>
												<p class="text-muted text-center"><?php echo $a['category']; ?></p>
											</div>
											<!-- /.box-body -->
										</div>
									</div>
								<?php 
								}
								?>
							</div>   	
						</div>
						<!-- /.tab-pane -->
						<div class="tab-pane" id="promotedCompanies">
							<div class="row">
								<?php
						   		foreach ($this->data['companies'] as $a)
						   		{
						   			$logo = "";
						   			if ($a['logo'])
									{
										$logo = "/media/companies/logo/".$a['logo'];
									}
									else {
										$logo = "/dist/img/default/companies/logo/logo.jpg";
									}
									
									if ($a['promoted'] == 1)
									{
								?>
									<div class='col-lg-3 col-md-6 company-item'>
										<div class="box box-primary">
											<div class="box-body box-profile">
												<a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><img class="profile-user-img img-responsive" src="<?php echo $logo; ?>" alt="User profile picture"></a>
												<h3 class="profile-username text-center"><a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><?php echo $a['name']; ?></a></h3>
												<p class="text-muted text-center"><?php echo $a['category']; ?></p>
											</div>
											<!-- /.box-body -->
										</div>
									</div>
								<?php 
									}
								}
								?>
							</div>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<?php 
			else : 
			?>
			<?php
	   		foreach ($this->data['companies'] as $a)
	   		{
	   			$logo = "";
	   			if ($a['logo'])
				{
					$logo = "/media/companies/logo/".$a['logo'];
				}
				else {
					$logo = "/dist/img/default/companies/logo/logo.jpg";
				}
			?>
				<div class='col-lg-3 col-md-6 company-item'>
					<div class="box box-primary">
						<div class="box-body box-profile">
							<a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><img class="profile-user-img img-responsive" src="<?php echo $logo; ?>" alt="User profile picture"></a>
							<h3 class="profile-username text-center"><a href="/edit-company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" ><?php echo $a['name']; ?></a></h3>
							<p class="text-muted text-center"><?php echo $a['category']; ?></p>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			<?php 
			}
			?>
			<?php
			endif;
			?>
   		
		</div>
   		<?php		
   		$items = ob_get_contents();
   		ob_end_clean();
   		return $items;
   	}
   	
    
   	public function getEditCompanyHead()
    {
    	ob_start();
    	?>
    	<!-- bootstrap wysihtml5 - text editor -->
  		<link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  		<link href="/plugins/jquery.uploadfile/uploadfile.css" rel="stylesheet">
  		<link href="/plugins/jquery.drag-n-crop/jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
  		<!-- Select2 -->
  		<link rel="stylesheet" href="/plugins/select2/select2.min.css">
  		<!-- bootstrap datepicker -->
  		<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getEditCompanyScripts()
    {
    	ob_start();
    	?>
    	<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    	
    	<script src="/plugins/jQueryUI/jquery-ui.min.js"></script>
    	<script src="/plugins/jquery.uploadfile/jquery.uploadfile.min.js"></script>
    	<script src="/plugins/imagesloaded/imagesloaded.js"></script>
		<script src="/dist/js/scale.fix.js"></script>
		<script src="/plugins/jquery.drag-n-crop/jquery.drag-n-crop.js"></script>
		<!-- Select2 -->
		<script src="/plugins/select2/select2.full.min.js"></script>	
		<!-- bootstrap datepicker -->
		<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
		
    	<script type="text/javascript">
    	$(function () {
    	    //bootstrap WYSIHTML5 - text editor
    	    $(".textarea").wysihtml5();
		});

    	<?php 
    	$i 		= 0;
    	$varSub = '';
    			
		foreach ($this->data['belongSubcategories'] as $s)
		{
			$varSub .= "subcategories[".$i."] = ".$s['subcategory'].'; ';
			$i++;
		}
    	    	
		$varLoc = '';
		$i 		= 0;
		foreach ($this->data['companiesLocations'] as $c)
		{
			$varLoc .= "locations[".$i."] = ".$c['ubication'].'; ';
			$i++;
		}
		?>

		var subcategories = new Array(<?php echo count($this->data['belongSubcategories'])?>);
		var locations = new Array(<?php echo count($this->data['companiesLocations'])?>);
    			
    	<?php echo $varSub; ?>
		<?php echo $varLoc; ?>

    	$(document).ready(function()
		{
			checkSubategories(subcategories);
			checkLocations(locations);

			$('#categories a').click(function(){
				changeCategory(this);
			});

			$('#subcategories a').click(function(){
				updateSubcategoriesByCompany(this);
			});

    		$('#locations a').click(function(){
				updateCompanyLocation(this);
			});

    		//Initialize Select2 Elements
    	    $(".select2").select2();

    	  //Date picker
    	    $('#eventDate, #newEventDate').datepicker({
    	      autoclose: true
    	    });
		});
  	  
		</script>
		<script src="/dist/js/company.js"></script>
		
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getEditCompanyContent()
    {
    	ob_start();
    	?>
    	<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
						<li><a href="#generalInfo" data-toggle="tab">General</a></li>
						<li><a href="#seoInfo" data-toggle="tab">SEO</a></li>
						<li><a href="#mediaInfo" data-toggle="tab">Media</a></li>
						<li><a href="#contactInfo" data-toggle="tab">Contact</a></li>
						<li><a href="#socialInfo" data-toggle="tab">Social</a></li>
						<?php 
						if ($this->data['company']['general']['event'] == 0)
						{
							?>
						<li><a href="#eventsInfo" data-toggle="tab">Events</a></li>
						<?php 
						}
						?>
						<li><a href="#settingsInfo" data-toggle="tab">Settings</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="profile">
							<div class="row">
								<div class="col-md-12">
									<!-- Widget: user widget style 1 -->
									<div class="box box-widget widget-user-2">
										<!-- Add the bg color to the header using any of the bg-* classes -->
										<div class="widget-user-header bg-aqua-active">
											<div class="widget-user-image">
												<?php 
							   					if ($this->data['company']['logo']['logo'])
							   					{
							   						?>
							   						<img id="companyLogo" src="/media/companies/logo/<?php echo $this->data['company']['logo']['logo']; ?>"  />
							   						<?php 
							   					}
							   					else
							   					{
							   						?>
							   						<img id="companyLogo" src="/dist/img/default/companies/logo/logo.jpg"  width="300" height="150" />
							   						<?php
							   					}
							   					?>
											</div>
											<!-- /.widget-user-image -->
											<h3 class="widget-user-username"><?php echo $this->data['company']['general']['name']; ?></h3>
											<h5 class="widget-user-desc"><?php echo $this->data['company']['general']['category_name']; ?></h5>
											<h6 class="widget-user-desc"><?php echo stripslashes($this->data['company']['seo']['description']); ?></h6>
										</div>
										<div class="box-footer no-padding">
											<ul class="nav nav-stacked">
												<?php 
												foreach ($this->data['company']['emails'] as $e)
												{
												?>
												<li><a href="#"><?php echo $e['e_mail']; ?></a></li>
												<?php
												}
												?>
												<?php 
												foreach ($this->data['company']['phones'] as $p)
												{
												?>
												<li><a href="#"><?php echo $p['telephone']; ?></a></li>
												<?php
												}
												?>
												<?php 
												if ($this->data['company']['general']['event'] == 0)
												{
													?>
												<li><a href="#">Events <span class="pull-right badge bg-blue">31</span></a></li>
													<?php
												}
												?>
												
												<li></li>
											</ul>
										</div>
									</div>
									<!-- /.widget-user -->
								</div>
								<!-- /.col -->        
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="generalInfo">
							<div class="row">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">About Me</h3>
									</div>
									<!-- /.box-header -->
									<div class="box-body">
										<strong><i class="fa fa-book margin-r-5"></i> Categories</strong>
										<?php 
										if ($this->data['company']['general']['event'] == 0)
										{
											?>
										<div class="categoriesSelection">
											<div class="categoriesBox" id="categories">
						   						<ul>
						   							<?php 
						   							foreach ($this->data['categories'] as $category) 
													{
						   								?>
						   								<li><a href="javascript: void(0);" 
						   								<?php 
						   								if ($this->data['company']['general']['category'] == $category['category_id']) {
						   									?>
						   									class="active"
						   									<?php 
						   								}
						   								?>
						   								category_id="<?php echo $category['category_id']; ?>"
						   								><?php echo $category['name']; ?></a></li>
						   								<?php
						   							}
						   							?>
								   				</ul>
						   					</div>
										</div>
										<div class="clear"></div>
										<hr>
										
										<strong><i class="fa fa-book margin-r-5"></i> Subcategories</strong>
										<div class="categoriesBox categoriesSelection" id="subcategories">
					   						<ul>
							   					<?php 
					   							foreach ($this->data['subcategories'] as $subcategory) {
					   								?>
					   								<li><a href="javascript: void(0);" id="sub_<?php echo $subcategory['subcategory_id']; ?>" subcategory="<?php echo $subcategory['subcategory_id']; ?>" ><?php echo $subcategory['name']; ?></a></li>
					   								<?php
					   							}
					   							?>
							   				</ul>
					   					</div>
										<div class="clear"></div>
										<hr>
										
										<strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
										<div class="categoriesBox categoriesSelection" id="locations">
					   						<ul>
							   					<?php 
					   							foreach ($this->data['locations'] as $location) {
					   								?>
					   								<li><a href="javascript: void(0);" id="lo_<?php echo $location['location_id']; ?>" location="<?php echo $location['location_id']; ?>"><?php echo $location['name']; ?></a></li>
					   								<?php
					   							}
					   							?>
							   				</ul>
					   					</div>
					   					<div class="clear"></div>
										<hr>
										<?php 
										}
										?>
										<form class="form-horizontal">
						                	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Name</label>
												<div class="col-sm-11">
													<input type="" class="form-control" id="companyName" placeholder="Name" value="<?php echo $this->data['company']['general']['name']; ?>">
												</div>
						                  	</div>
						                  	
						                  	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Lat & Long</label>
												<div class="col-sm-11">
													<input type="" class="form-control" id="companyLocation" placeholder="Lat & Long" value="<?php echo $this->data['company']['general']['latitude'].','.$this->data['company']['general']['longitude']; ?>">
												</div>
						                  	</div>
						                  	
						                  	<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Description</label>
												<div class="col-sm-11">
													<div class="box-body pad">
														<form>
															<textarea class="textarea" id="company-description" placeholder="Place some text here" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $this->data['company']['general']['description']; ?></textarea>
														</form>
													</div>
												</div>
											</div>
						                  	
											<div class="form-group">
												<div class="col-sm-offset-1 col-sm-10">
													<button type="submit" class="btn btn-success save-company-info">Save</button>
												</div>
											</div>
						                </form>
									</div>
									<!-- /.box-body -->
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="seoInfo">
							<form class="form-horizontal">
								<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Title</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companySeoTitle" placeholder="Title" value="<?php echo $this->data['company']['seo']['title']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Keywords</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companySeoKeywords" placeholder="Keywords" value="<?php echo $this->data['company']['seo']['keywords']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Description</label>
									<div class="col-sm-11">
										<textarea class="form-control" id="companySeoDescription" placeholder="Description"><?php echo $this->data['company']['seo']['description']; ?></textarea>
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-seo">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="mediaInfo">
							<div class="row">
								<input type="hidden" id="logoId" value="<?php echo $this->data['company']['logo']['logo_id']; ?>" />
								<input type="hidden" id="companyNameClean" value="<?php echo Tools::slugify($this->data['company']['general']['name']); ?>" />
								
								<div class="col-md-12">
									<div class="mediaSections" >
										<h2>Logo</h2>
										<p class="text-muted">(300px / 150px | JPG)</p>
										
										<div class="">
											<div class="logo-uploader">
												Upload
											</div>
											<div class="logo-box">
												<div style="width: 300px; height:150px" class="crop-container-logo"> <img src="/media/companies/logo/<?php echo $this->data['company']['logo']['logo']; ?>" id="cropLogo" /></div>
											</div>
											<br>
											<div class="form-group">
												<div class="col-sm-12">
													<button type="submit" class="btn btn-success" id="save-crop-logo">Save</button>
												</div>
											</div>
											
											<div class="clr"></div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="mediaSections" >
										<h2>Sliders</h2>
										<p class="text-muted">(1170px / 526px)</p>
										
										<div class="slider-box">
											<div class="company-slider-uploader">
												Upload
											</div>
											<div class="company-slider-upload">
												<div class="crop-box">
													<div style="width: 600px; height:270px" class="crop-container"> <img src="" id="crop-company-slider" /></div>
												</div>
												<br>
												<div class="form-group">
													<div class="col-sm-12">
														<button type="submit" class="btn btn-success" id="save-crop-company-slider">Save</button>
													</div>
												</div>
												
												<div class="clr"></div>
											</div>
											
											<div id="slider-items" class="">
												<?php 
												foreach($this->data['company']['sliders'] as $slider) 
												{
												?>
												<div class="slider-item col-md-4" id="sid-<?php echo $slider['sliders_id']; ?>">
													<header>
														<a href="#" class="button red delete-slider" sid="<?php echo $slider['sliders_id']; ?>">delete</a>
													</header>
													<section>
														<div class="img-container">
										    				<img src="/media/companies/sliders/<?php echo $slider['slider']; ?>" class="img-responsive" />
										    			</div>
													</section>
													<div class="clr"></div>
												</div>
												<?php 
												}
												?>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-md-12">
								
									<div class="mediaSections" >
										<h2>Gallery</h2>
										
										<div class="company-gallery-uploader">
											Upload
										</div>
										
										<div class="company-gallery-grid">
											<?php
											if ($this->data['company']['gallery'])
											{
												foreach($this->data['company']['gallery'] as $g)
												{
												?>
												<div class="image-box" id="cgid-<?php echo $g['picture_id']; ?>">
													<div class="image">		
														<img src="/media/companies/gallery/<?php echo $g['picture']; ?>" />
													</div>
													<a href="javascript:void(0);" cgid="<?php echo $g['picture_id']; ?>" class="deleteGallery" >delete</a>
												</div>
												<?php
												}
											}
											?>
											<div class="clr"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="contactInfo">
							<form class="form-horizontal">
								<div id="companyEmails">
									<?php
									if ($this->data['company']['emails'])
									{
										$i = 0;
										foreach ($this->data['company']['emails'] as $e)
										{
										?>
										<div class="form-group">
											<label for="inputName" class="col-sm-1 control-label">Email 
												<?php 
												if ($i == 0)
												{
													?>
												<span id="addEmailField">[+]</span>
													<?php 
												}
												?>
											</label>
											<div class="col-sm-11">
												<input type="text" value="<?php echo $e['e_mail']; ?>" placeholder="email" class="companyEmail form-control" eid="<?php echo $e['e_mail_id']; ?>" />
											</div>
										</div>
										<?php
										$i++;
										}
									}
									else
									{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Email 
												<span id="addEmailField">[+]</span>
											</label>
											<div class="col-sm-11">
												<input type="text" value="" class="companyEmail form-control" eid="0" />
											</div>
										</div>
										<?php 
									}
									?>
								</div>
							
			                  	<div id="companyPhones">
			                  		<?php
									if ($this->data['company']['phones'])
									{
										$i = 0;  						
										foreach ($this->data['company']['phones'] as $p)
										{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Phone
												<?php 
													if ($i == 0)
													{
														?>
													<span id="addPhoneField">[+]</span>
														<?php 
													}
													?>
											</label>
											<div class="col-sm-11">
												<input type="text" value="<?php echo $p['telephone']; ?>" class="companyPhone form-control" pid="<?php echo $p['telephone_id']; ?>" />
											</div>
										</div>
										<?php
										$i++;
										}
									}
									else 
									{
										?>
										<div class="form-group">
											<label class="col-sm-1 control-label">Phone <span id="addPhoneField">[+]</span> </label>
											<div class="col-sm-11">
												<input type="text" value="" class="companyPhone form-control" pid="0" />
											</div>
										</div>
										<?php 
									}
									?>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    		<label for="inputName" class="col-sm-1 control-label">Website</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyWebsite" placeholder="website" value="<?php echo $this->data['company']['general']['website']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-contact">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="socialInfo">
							<form class="form-horizontal">
								<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Twitter</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyTwitter" placeholder="Twitter" value="<?php echo $this->data['company']['social']['tuit_url']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Facebook</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyFacebook" placeholder="Facebook" value="<?php echo $this->data['company']['seo']['facebook']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Tripadvisor</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyTripadvisor" placeholder="Tripadvisor" value="<?php echo $this->data['company']['seo']['tripadvisor']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Youtube</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyYoutube" placeholder="Youtube" value="<?php echo $this->data['company']['seo']['youtube']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Pinterest</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyPinterest" placeholder="Pinterest" value="<?php echo $this->data['company']['seo']['pinterest']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
			                    	<label for="inputName" class="col-sm-1 control-label">Instagram</label>
									<div class="col-sm-11">
										<input type="" class="form-control" id="companyInstagram" placeholder="Instagram" value="<?php echo $this->data['company']['seo']['instagram']; ?>">
									</div>
			                  	</div>
			                  	
			                  	<div class="form-group">
									<div class="col-sm-offset-1 col-sm-10">
										<button type="submit" class="btn btn-success save-company-social">Save</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="eventsInfo">
							<div class="box box-info">
				            	<div class="box-header with-border"></div>
				            	
								<div class="nav-tabs-custom tab-warning">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#tab_1" data-toggle="tab"><b>Associate an event</b></a></li>
										<li><a href="#tab_2" data-toggle="tab"><b>Create an event</b></a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1">
											<div class="form-group">
												<label>Find your event</label>
												<select class="form-control select2" id="eventId" style="width: 100%;">
													<option value="0" selected="selected">Event name</option>
													<?php 
													foreach ($this->data['events'] as $event)
													{
														?>
														<option value="<?php echo $event['company_id']; ?>"><?php echo $event['name']; ?></option>
														<?php
													}
													?>
													
												</select>
											</div>
											<!-- /.form-group -->
										
											<!-- Date -->
											<div class="form-group">
												<label>Date:</label>
												
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="eventDate">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
              								
              								<div class="box-footer">
												<button type="submit" class="btn btn-primary" id="asociateEvent">Associate event</button>
											</div>
										</div>
										<!-- /.tab-pane -->
										<div class="tab-pane" id="tab_2">
											
											<div class="form-group">
												<label for="exampleInputEmail1">Event name</label>
												<input type="text" class="form-control" id="newEventName" placeholder="Event name">
											</div>
											
											<!-- Date -->
											<div class="form-group">
												<label>Date:</label>
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="newEventDate">
												</div>
												<!-- /.input group -->
											</div>
											<!-- /.form group -->
              								
              								<div class="box-footer">
												<button type="submit" class="btn btn-primary" id="addEvent">Add event</button>
											</div>
										</div>
										<!-- /.tab-pane -->
									</div>
									
									<!-- /.tab-content -->
								</div>
				          	</div>
				          	<div class="box box-info">
				            	<div class="box-header with-border"><b>Evens associated to <?php echo $this->data['company']['general']['name']; ?></b></div>
				            	<div class="row" id="boxAssociatedEvents">
				            		<?php 
				            		if ($this->data['associated'])
				            		{
				            			foreach ($this->data['associated'] as $event)
				            			{
				            				?>
				            		<div class="col-lg-4 col-md-6 event-item">
										<div class="box box-success">
											<div class="box-body box-profile">
												<?php 
							   					if ($event['logo'])
							   					{
							   						?>
							   						<img class="profile-user-img img-responsive" src="/media/companies/logo/<?php echo $event['logo']; ?>" alt="User profile picture">
							   						<?php 
							   					}
							   					else
							   					{
							   						?>
							   						<img class="profile-user-img img-responsive" src="/images/default_item_front.jpg" alt="User profile picture">
							   						<?php
							   					}
							   					?>
												<h3 class="profile-username text-center"><?php echo $event['name']; ?></h3>
												<p class="text-center"><?php echo Tools::formatMYSQLToFront($event['date']); ?></p>
												<a href="/admin/edit-company/main/<?php echo $event['company_id']; ?>/<?php echo Tools::slugify($event['name']); ?>/" class="btn btn-primary btn-block"><b>Edit</b></a>
												<a href="#" class="btn btn-danger btn-block deleteEvent" data-event-id="<?php echo $event['company_id']; ?>"><b>Delete</b></a>
											</div>
											<!-- /.box-body -->
										</div>
									</div>
				            				<?php
				            			}
				            		}
				            		?>
				            	
				            	</div>
				            </div>
						</div>
						<!-- /.tab-pane -->
						
						<div class="tab-pane" id="settingsInfo">
							<form class="form-horizontal">
							<?php 
							if ($this->data['company']['general']['event'] == 0)
							{
								?>
								<div class="form-group">
									<div class="col-sm-4">
										<button type="button" id="mainPromoteCompany" class="btn btn-block btn-default <?php if ($this->data['company']['general']['main_promoted'] == 1){ echo 'bg-green';} ?>">Main Promoted</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
							<?php 
							}
							?>
							
							<?php 
							if ($this->data['company']['general']['event'] == 0)
							{
								?>
								<div class="form-group">
									<div class="col-sm-4">
										<button type="button" id="promoteCompany" class="btn btn-block btn-default <?php if ($this->data['company']['general']['promoted'] == 1){ echo 'bg-green';} ?>">Category Promoted</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
							<?php 
							}
							?>
								<div class="form-group">
									<div class="col-sm-4">
										<button type="button" id="publish-company" class="btn btn-block btn-default <?php if ($this->data['company']['general']['published'] == 1){ echo 'bg-green';} ?>">Published</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								
								<?php 
								if ($this->data['company']['general']['event'] == 0)
								{
									?>
								<div class="form-group">
									<div class="col-sm-4">
										<button type="button" id="close-company" class="btn btn-block btn-default <?php if ($this->data['company']['general']['closed'] == 1){ echo 'bg-red';} ?>">Archived</button>
									</div>
									<div class="col-sm-10"></div>
								</div>
								<?php 
								}
								?>
							</form>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getMainGalleryHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<link href="/plugins/jquery.uploadfile/uploadfile.css" rel="stylesheet">
    	<link href="/plugins/jquery.drag-n-crop/jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getMainGalleryScripts()
    {
    	ob_start();
    	?>
    	<script src="/plugins/jQueryUI/jquery-ui.min.js"></script>
    		<script src="/plugins/jquery.uploadfile/jquery.uploadfile.min.js"></script>
    		<script src="/plugins/imagesloaded/imagesloaded.js"></script>
			<script src="/plugins/scale.fix/scale.fix.js"></script>
			<script src="/plugins/jquery.drag-n-crop/jquery.drag-n-crop.js"></script>
			<script src="/dist/js/main-sliders.js"></script>
        	<script type="text/javascript">
			width 	= 0;
			height 	= 0;
			image 	= "";
			x		= 0;
			y		= 0;
			lastId 	= 0;
			
			var dnd;
			
        	$(document).ready(function()
        	{
        		$(".uploader").uploadFile({
	        		url:"/ajax/main-sliders.php?option=1",
	        		fileName:"myfile",
	        		multiple: false,
	        		doneStr:"uploaded!",
	        		onSuccess:function(files,data,xhr)
	        		{
	        			obj 	= JSON.parse(data);
	        			width 	= obj.wp;
	        			height 	= obj.hp;
	        			image 	= obj.fileName;
	        			lastId 	= obj.lastId;
	        			createDrag(obj.fileName);
	        			$('.save-crop').show();
	        		}
        		});
				
        		function createDrag(image)
        		{
            		source = '/media/sliders/resized/'+image;
            		$('#crop').attr('src', source);
        			dnd = $('#crop').dragncrop({
            			instruction: false,
            			centered: false,
            			stop: function(evnt, position){
            			   	dimensions = String(position.dimension);
            			   	res = dimensions.split(",");
            			   	x = res[0];
            			   	y = res[1];
            			  }
                    });
            	}

            	$('#save-crop').click(function(){
					save();
					dnd.dragncrop('destroy');
					return false;
                });

            	$('#add-slider').click(function(){
            		$('.main-slider-upload').show();
            		return false; 
                });

                $('.save-slider').click(function(){
					saveSliderData($(this).attr('sid'));
					return false;
                });

                $('.delete-slider').click(function(){
                	deleteSlider($(this).attr('sid'));
					return false;
                });
        	});
        	
        	function save()
        	{
        		imgId = image;
        		
        	    $.ajax({
        	        type:   'POST',
        	        url:    '/ajax/main-sliders.php?option=2',
        	        data:{  x: x,
        	                y: y,
        	            imgId: imgId
        	             },
        	        success:
        	        function(xml)
        	        {
            	        
        	            if (0 != xml)
        	            {
        	            	$('.main-slider-upload').fadeOut();
        	            	item = '<div class="slider-item main-slider-item" id="sid-'+lastId+'">'
								+'<header>'
									+'<a href="#" class="btn btn-danger btn-xs delete-slider" sid="'+lastId+'"> delete</a>'
									+'<a href="#" class="btn btn-info btn-xs save-slider" sid="'+lastId+'"> save</a>'
								+'</header>'
								+'<div class="row">'
 									+'<div class="col-md-2"><br>'
										+'<div class="img-container">'
											+'<img src="/media/sliders/thumbnail/'+imgId+'" />'
										+'</div>'
 									+'</div>'
									+'<div class="col-md-10"><br>'
										+'<div class="form-group">'
								        	+'<label for="inputName" class="col-sm-1 control-label">Title</label>'
								        	+'<div class="col-sm-11">'
												+'<input type="" class="form-control slider-title" placeholder="Title" value="">'
											+'</div>'
								      	+'</div>'
								      	
								      	+'<div class="form-group">'
								        	+'<label for="inputName" class="col-sm-1 control-label">Link</label>'
								        	+'<div class="col-sm-11">'
												+'<input type="" class="form-control slider-link" placeholder="Link" value="">'
											+'</div>'
								      	+'</div>'
								      	
								      	+'<div class="form-group">'
								        	+'<label for="inputName" class="col-sm-1 control-label">Promos</label>'
								        	+'<div class="col-sm-11">'
												+'<input type="" class="form-control slider-promos" placeholder="Promos" value="">'
											+'</div>'
								      	+'</div>'
									+'</div>'
	 							+'</div>'
	 						+'</div>';
					

							$('#slider-items').prepend(item);

							$('.save-slider').click(function(){
								saveSliderData($(this).attr('sid'));
								return false;
			                });

			                $('.delete-slider').click(function(){
			                	deleteSlider($(this).attr('sid'));
								return false;
			                });
        	            }
        	        }
        	    });
        	}
    		</script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getMainGalleryContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-12">
				<div class="content-box">
					<header>
						<div class="form-group">
							<div class="col-sm-2">
								<button type="button" id="add-slider" class="btn btn-block btn-info ">Add Slider</button>
							</div>
							<div class="col-sm-10"></div>
						</div>
					</header>
					
					<div class="clear"></div>
					<br>
					<p class="text-muted">(1200px / 674px | JPG)</p>
			
					<div class="slider-box">
						<div class="main-slider-upload">
							<div class="uploader">
								Upload
							</div>
							<div class="clear"></div>
							<br>
							<div class="crop-box">
								<div style="width: 800px; height:448px" class="crop-container"><img src="" id="crop" /></div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-1">
									<button type="button"class="btn btn-sm btn-block btn-info save-crop"  id="save-crop">Save</button>
								</div>
								<div class="col-sm-11"></div>
							</div>
							
							<div class="clear"></div>
						</div>
						<div id="slider-items">
							<?php 
							foreach ($this->data['mainSliders'] as $slider) {
							?>
							<div class="slider-item main-slider-item" id="sid-<?php echo $slider['picture_id']; ?>">
								<header>
									<a href="#" class=" btn btn-danger btn-xs delete-slider" sid="<?php echo $slider['picture_id']; ?>">delete</a>
									<a href="#" class="btn btn-info btn-xs save-slider" sid="<?php echo $slider['picture_id']; ?>">save</a>
								</header>
								<div class="row">
									<div class="col-md-2">
										<br>
										<div class="img-container">
						    				<img src="/media/sliders/thumbnail/<?php echo $slider['name']; ?>" />
						    			</div>
					    			</div>
					    			<div class="col-md-10">
					    				<br>
					    				<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Title</label>
											<div class="col-sm-11">
												<input type="" class="form-control slider-title" placeholder="Title" value="<?php echo $slider['title']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Link</label>
											<div class="col-sm-11">
												<input type="" class="form-control slider-link" placeholder="Link" value="<?php echo $slider['link']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Promos</label>
											<div class="col-sm-11">
												<input type="" class="form-control slider-promos" placeholder="Promos" value="<?php echo $slider['promos']; ?>">
											</div>
					                  	</div>
					                  	
									</div>
								</div>
								<div class="clr"></div>
							</div>
							<?php 
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getMainVideosHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getMainVideosScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
		<script src="/js/back/videos.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getMainVideosContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-12">
				<form class="form-horizontal">
					<div class="form-group">
	                   	<label for="inputName" class="col-md-1 control-label">Video URL</label>
						<div class="col-md-10">
							<input type="" class="form-control slider-link" placeholder="e.g. https://www.youtube.com/watch?v=Clg1IbQ7sNY" value="" id="videoURL">
						</div>
						<div class="col-md-1">
							<button type="button" id="add-slider" class="btn btn-block btn-info addVideo">Add Video</button>
						</div>
	                </div>
                </form>
			</div>
			
			<div class="col-md-12">
				<div class="videos swipebox-video">
					<?php 
					foreach ($this->data['videos'] as $video)
					{
					$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
					?>
					<div id="video-<?php echo $video['video_id']; ?>" class="col-md-3">
						<article class='protip'>
							<header>
								<div class="img-cover">	
									<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title">
										<img src="<?php echo $image; ?>"
												alt="<?php $video['title']; ?>"  class="protip_li_img"/>
									</a>
								</div>
							</header>
							<div class="clr"></div>
							<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title " style="font-size: 1.2em; font-weight: bold;">
								<?php echo $video['title']; ?>
							</a>
							<a href="javascript:void(0);" vid="<?php echo $video['video_id']; ?>" class="delete">delete</a>
						</article>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
    public function getSettingsHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSettingsScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
		<script src="/dist/js/settings.js"></script>
		<script src="/dist/js/categories.js"></script>
		<script src="/dist/js/locations.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSettingsContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#generalSettings" data-toggle="tab">General</a></li>
						<li><a href="#categoriesSettings" data-toggle="tab">Categories</a></li>
						<li><a href="#locationSettings" data-toggle="tab">Locations</a></li>
					</ul>
					<div class="tab-content">
						<div class="active tab-pane" id="generalSettings">
							<div class="row">
								<div class="col-md-12">
									<form class="form-horizontal">
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Title</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteTittle" placeholder="Title" value="<?php echo $this->data['appInfo']['title']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Site name</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteName" placeholder="Site name" value="<?php echo $this->data['appInfo']['siteName']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">URL</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteUrl" placeholder="URL" value="<?php echo $this->data['appInfo']['url']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Content</label>
											<div class="col-sm-11">
												<textarea class="form-control" id="siteContent" placeholder="Content"><?php echo $this->data['appInfo']['content']; ?></textarea>
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Description</label>
											<div class="col-sm-11">
												<textarea class="form-control" id="siteDescription" placeholder="Description"><?php echo $this->data['appInfo']['description']; ?></textarea>
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Keywords</label>
											<div class="col-sm-11">
												<textarea class="form-control" id="siteKeywords" placeholder="Keywords"><?php echo $this->data['appInfo']['keywords']; ?></textarea>
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Email</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteEmail" placeholder="Email" value="<?php echo $this->data['appInfo']['email']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Location</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteLocation" placeholder="Location" value="<?php echo $this->data['appInfo']['location']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Twitter</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteTwitter" placeholder="Twitter" value="<?php echo $this->data['appInfo']['twitter']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Facebook</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteFacebook" placeholder="Facebook" value="<?php echo $this->data['appInfo']['facebook']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Google+</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteGoogleplus" placeholder="Google +" value="<?php echo $this->data['appInfo']['googleplus']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Pinterest</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="sitePinterest" placeholder="Pinterest" value="<?php echo $this->data['appInfo']['pinterest']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">LinkedIn</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteLinkedin" placeholder="LinkedIn" value="<?php echo $this->data['appInfo']['linkedin']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Youtube</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteYoutube" placeholder="Youtube" value="<?php echo $this->data['appInfo']['youtube']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Instagram</label>
											<div class="col-sm-11">
												<input type="" class="form-control" id="siteInstagram" placeholder="Instagram" value="<?php echo $this->data['appInfo']['instagram']; ?>">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
											<div class="col-sm-offset-1 col-sm-10">
												<button type="submit" class="btn btn-sm btn-info update-settings">Save</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="categoriesSettings">
							<div class="row">
								<div class="col-md-6">
									<form class="form-horizontal">
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Name</label>
											<div class="col-sm-8">
												<input type="" class="form-control" id="categoryName" placeholder="Category name" value="">
											</div>
											<div class="col-sm-2">
												<button type="submit" class="btn btn-sm btn-info addCategory">Add</button>
											</div>
					                  	</div>
									</form>
									<div>
										<ul id="categoryList">
											<?php 
											foreach ($this->data['categories'] as $category)
											{
												?>
											<li id="cat-<?php echo $category['category_id']; ?>">
												<a href="javascript:void(0);" catId="<?php echo $category['category_id']; ?>">
													<?php echo $category['name']; ?>
												</a>
											</li>
												<?php
											}
											?>
										</ul>
									</div>
								</div>
								
								<div class="col-md-6" id="categorySettingsRight">
									<h4 id="catName"></h4>
									<form class="form-horizontal">
										<input type="hidden" value="0" id="currentCategory" />
										
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-2 control-label">Name</label>
											<div class="col-sm-10">
												<input type="" class="form-control" id="currentName" placeholder="Category name" value="">
											</div>
					                  	</div>
					                  	
					                  	<div class="form-group">
					                    	<label for="inputName" class="col-sm-2 control-label">Title</label>
											<div class="col-sm-10">
												<input type="" class="form-control" id="currentTitle" placeholder="Category title" value="">
											</div>
					                  	</div>
					                  	
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-2 control-label">Description</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="currentDescription" rows="3" placeholder="Category description"></textarea>
											</div>
					                  	</div>
										
										<div class="form-group">
											<div class="col-sm-offset-8 col-sm-10">
												<button type="submit" class="btn btn-xs btn-danger delete-category">Delete</button>
												<button type="submit" class="btn btn-xs btn-info update-category">Save</button>
											</div>
										</div>
										
										<div class="clr"></div>
									</form>
										
									<h3>Subcategories</h3>
										
									<div>
										<form class="form-horizontal">
											<div class="form-group">
						                    	<label for="inputName" class="col-sm-1 control-label">Name</label>
												<div class="col-sm-8">
													<input type="" class="form-control" id="subcategoryName" placeholder="Subcategory name" value="">
												</div>
												<div class="col-sm-2">
													<button type="submit" class="btn btn-xs btn-info addSubcategory">Add</button>
												</div>
						                  	</div>
										</form>
									</div>
										
									
									<div class="clr"></div>
									
									<ul id="subcategoryList">
										
									</ul>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="locationSettings">
							<div class="row">
								<div class="col-md-6">
									<form class="form-horizontal">
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-1 control-label">Name</label>
											<div class="col-sm-8">
												<input type="" class="form-control" id="locationName" placeholder="Location name" value="">
											</div>
											<div class="col-sm-2">
												<button type="submit" class="btn btn-success addLocation">Add</button>
											</div>
					                  	</div>
									</form>
									<div>
										<ul id="locationList">
											<?php 
											foreach ($this->data['locations'] as $location)
											{
												?>
											<li id="loc-<?php echo $location['location_id']; ?>">
												<a href="javascript:void(0);" locId="<?php echo $location['location_id']; ?>">
													<?php echo $location['name']; ?>
												</a>
											</li>
												<?php
											}
											?>
										</ul>
									</div>
								</div>
								
								<div class="col-md-6" id="locationSettingsRight">
									<h4 id="locName"></h4>
									<form class="form-horizontal">
										<input type="hidden" value="0" id="currentLocation" />
										
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-2 control-label">Name</label>
											<div class="col-sm-10">
												<input type="" class="form-control" id="currentLocationName" placeholder="Location name" value="">
											</div>
					                  	</div>
					                  	
										<div class="form-group">
					                    	<label for="inputName" class="col-sm-2 control-label">Description</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="currentLocationDescription" rows="3" placeholder="Category description"></textarea>
											</div>
					                  	</div>
										
										<div class="form-group">
											<div class="col-sm-offset-8 col-sm-10">
												<button type="submit" class="btn btn-sm btn-danger delete-location">Delete</button>
												<button type="submit" class="btn btn-sm btn-info update-location">Save</button>
											</div>
										</div>
										
										<div class="clr"></div>
									</form>
										
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }   
    
    public function getAddCompanyHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getAddCompanyScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
		<script src="/js/back/company.js"></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getAddCompanyContent()
    {
    	ob_start();
    	?>
		<div class="row">
			<div class="col-md-6 col-center">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Add a company</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form">
						<div class="box-body">
							<div class="form-group">
								<input type="text" class="form-control" id="new-company-name" placeholder="Enter company name">
							</div>
							<!-- 
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
										It's a <strong>company</strong>!
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
										It's an <strong>event</strong>!
									</label>
								</div>
							</div>
							 -->
						</div>
						<!-- /.box-body -->
						
						<div class="box-footer">
							<button type="submit" class="btn btn-primary" id="create-company">Add it now!</button>
							<button type="submit" class="btn btn-success" id="create-company-next">Complete the info!</button>
						</div>
					              
					</form>
					<!-- Loading (remove the following to stop the loading)-->
					<div class="overlay" id="add-company-loader">
						<i class="fa fa-refresh fa-spin"></i>
						<p class="over-message text-light-blue">wait, we are saving the data ...</p>
					</div>
					<!-- end loading -->
					
				</div>
			</div>
		</div>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
   	
    public function getSectionHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript"></script>
    	<?php
    	$head = ob_get_contents();
    	ob_end_clean();
    	return $head;
    }
    
    public function getSectionScripts()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
		<script src=""></script>
    	<?php
    	$scripts = ob_get_contents();
    	ob_end_clean();
    	return $scripts;
    }
    
    public function getSectionContent()
    {
    	ob_start();
    	?>

        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
    
   	
   	/**
   	 * The very awesome footer!
   	 * 
   	 * <s>useless</s>
   	 * 
   	 * @return string
   	 */
    public function getFooter()
    {
    	ob_start();
    	?>
		<!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                <i><b>W2G</b> Leading the future <s>mofos</s></i>
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2018 <a href="#"><?php echo $this->data['appInfo']['siteName']; ?></a>.</strong> All rights reserved.
        </footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
	}
}