<?php
//phpinfo();die;

$path	= str_replace( '../', '', $_SERVER['SCRIPT_URL'] );
$path	= trim( $path, '/' );
//$path	= preg_replace( '@^\/@', '', $path );


$list	= array( 'folders' => array(), 'files' => array() );
$index	= new DirectoryIterator( '../'.$path );
foreach( $index as $item ){
	if( $item->isDot() || $item->getFilename()[0] === '.' )
		continue;
	if( in_array( strtolower( $item->getFilename() ), array( 'makefile' ) ) )
		continue;
	if( $item->isDir() )
		$list['folders'][]	= $item->getFilename();
	else{
		$list['files'][]	= $item->getFilename();
	}
}
$iconFolder	= '<i class="fa fa-fw fa-folder"></i>';
$iconFile	= '<i class="fa fa-fw fa-file-o"></i>';

$navItems	= array();
natcasesort( $list['folders'] );
natcasesort( $list['files'] );
foreach( $list['folders'] as $item ){
	$link		= '<a class="nav-link not-btn not-btn-link" href="'.$item.'">'.$iconFolder.'&nbsp;'.$item.'</a>';
	$navItems[]	= '<li class="not-list-group nav-item" data-type="folder">'.$link.'</li>';
}
foreach( $list['files'] as $item ){
	$link		= '<a class="nav-link not-btn not-btn-link" href="'.$item.'">'.$iconFile.'&nbsp;'.$item.'</a>';
	$navItems[]	= '<li class="not-list-group-item nav-item" data-type="file">'.$link.'</li>';
}
$navList	= '<ul class="not-list-group nav flex-column">'.join( $navItems ).'</ul>';

function renderPosition( $path ){
	$position	= array();// '<li class="breadcrumb-item"><strong>Position: </strong></li>' );
	if( strlen( $path ) ){
		$pathParts	= explode( '/', $path );
		$way		= '/';
		$position[]	= '<li class="breadcrumb-item"><a href="/">Home</a></li>';
		foreach( $pathParts as $nr => $part ){
			$way	.= $part.'/';
			if( $nr + 1 == count( $pathParts ) )
				$position[]	= '<li class="breadcrumb-item active">'.$part.'</li>';
			else
				$position[]	= '<li class="breadcrumb-item"><a href="'.$way.'">'.$part.'</a></li>';
		}
	}
	else
		$position[]	= '<li class="breadcrumb-item">Home</li>';
	$position	= '<ul class="breadcrumb">'.join( $position ).'</ul>';
	return $position;
}
$position	= renderPosition( $path );

$info		= '';
$infoFile	= 'README.md';
$infoFilePath	= '../'.$path.'/'.$infoFile;
if( file_exists( $infoFilePath ) ){
	$info	= '<xmp>'.file_get_contents( $infoFilePath ).'</xmp>';
}

$darkMode	= FALSE;
$cdn		= 'https://cdn.ceusmedia.de/';
$style		= 'header{padding: 1em 1em;}@media (min-width: 768px){ul.nav{border-right: 1px solid rgba(127, 127, 127, 0.5)}}';
print '
<html>
	<head>
        <link rel="stylesheet" href="'.$cdn.'css/bootstrap/4.4.1/bootstrap.min.css"></link>
        <link rel="stylesheet" href="'.$cdn.'fonts/FontAwesome/font-awesome.min.css"></link>
        <script src="'.$cdn.'js/jquery/1.10.2.min.js"></script>
        <script src="'.$cdn.'js/bootstrap.min.js"></script>
        <style>'.$style.'</style>
    </head>
    <body class="'.( $darkMode ? 'dark' : 'bright' ).'">
        <div class="container">
			<header>
				<h2><span class="text-muted">Ceus Media</span> <abbr title="Content Distribution Network">CDN</abbr></h2>
			</header>
            <div class="row">
                <div class="col-md-12">
					'.$position.'
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    '.$navList.'
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="d-md-none d-lg-none d-sm d-xs"><br/><hr/></div>
					'.$info.'
				</div>
            </div>
			<br/>
			<div class="alert alert-warning" role="alert">
				<i class="fa fa-fw fa-warning"></i> <strong>Warning:</strong> You are <strong>not allowed to reference these resources</strong> within your project unless you are allowed to by <a class="alert-link" href="https://ceusmedia.de/">Ceus Media</a>.
			</div>
        </div>
    </body>
</html>';
