<?php 
if($page['load']['type']=='view_website'){
	
$page_template = $this->Apps($page['load']['apps'],$page['load']['page_view'] );
$page['template'] = $page_template['website']['template'];
}
?><link href="" rel="stylesheet" />
              
        <link href="<?=$this->urlframework($page['template'],'TopicListing-1.0.0/css/bootstrap.min.css')?>" rel="stylesheet">

        <link href="<?=$this->urlframework($page['template'],'TopicListing-1.0.0/css/bootstrap-icons.css')?>" rel="stylesheet">

        <link href="<?=$this->urlframework($page['template'],'TopicListing-1.0.0/css/templatemo-topic-listing.css')?>" rel="stylesheet">
        <body id="top">

<main>
 
    <NAV-HEADER></NAV-HEADER>
    <BANNER></BANNER>
    <BANNER-DETAIL></BANNER-DETAIL>
    <EXPLORE-SECTION></EXPLORE-SECTION>
    <TIMELINE-SECTION></TIMELINE-SECTION>
    <FAQ-SECTION></FAQ-SECTION>
    <CONTACT-SECTION></CONTACT-SECTION>
 
</main>
<FOOTER-SECTION></FOOTER-SECTION>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/click-scroll.js"></script>
<script src="js/custom.js"></script>

</body>      