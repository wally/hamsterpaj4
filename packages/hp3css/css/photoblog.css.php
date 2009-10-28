<?php
	$req_uri = $_SERVER['REQUEST_URI'];
	$uri_parts = explode('_', $_SERVER['REQUEST_URI']);
	
	$main_color = '#' . ((strlen($uri_parts[1]) > 2) ? $uri_parts[1] : '333');
	$detail_color = '#' . ((strlen($uri_parts[2]) > 2) ? $uri_parts[2] : 'FF8040');
	$contrast_color = '#' . ((hexdec($uri_parts[1]) > 8388607) ? '333' : 'eee');
?>

#photoblog_image img, #photoblog_header img {
    display: inline;
}

#photoblog_upload_wrapper {
	border: 1px solid #cfe2f1;
	-moz-border-radius: 5px;
	background: #f1f5ff;
	padding: 10px;
	margin-top: 20px;
}
	#photoblog_upload_upload_flash_objectarea {
		float: left;
	}
	#photoblog_upload_wrapper span {
		float: left;
		margin-left: 10px;
		margin-top: 3px;
	}

#photoblog_photo_properties_save
{
	display: none;
	float: right;
	clear: both;
	margin: 10px 0px 10px 0px;
}

.photoblog_photo_properties {
	border: 1px solid #cfe2f1;
	-moz-border-radius: 5px;
	background: #f1f5ff;
	margin-top: 5px;
	height: 172px;
}
	.photoblog_photo_properties_uploading {
		padding: 10px;
		text-align: center;
	}
		.photoblog_photo_properties_uploading h2 {
			font-size: 14px;
			margin-top: 50px;
		}
		.photoblog_photo_properties_uploading_progress_bar {
			width: 250px;
			text-align: center;
			margin: 0 auto;
			border: 1px solid #cfe2f1;
			-moz-border-radius: 5px;
			padding: 3px 0;
			background: #fff;
			background-image: url(http://images.hamsterpaj.net/photoblog/loader.png);
			background-repeat: no-repeat;
			background-position: -250px 0;
		}
	
	.photoblog_photo_properties .float {
		width: 176px;
	}
		.photoblog_photo_properties .thumbnail_wrapper {
			padding: 1px;
			border: 2px solid;
			width: 150px;
			margin: 10px;
		}
		.photoblog_photo_properties .rotate {
			margin: 0 55px 10px 50px;
		}
			.photoblog_photo_properties .rotate_left {
				margin-right: 10px;
				display: inline;
			}
			.photoblog_photo_properties .rotate_right {
				display: inline;
			}
	.photoblog_photo_properties .properties {
		margin-left: 166px;
		padding: 10px;
		position: absolute;
	}
		.photoblog_photo_properties_date {
			border: 1px solid #cfe2f1;
		}
		.photoblog_photo_properties_description {
			width: 450px;
			display: block;
			height: 130px;
			border: 1px solid #cfe2f1;
		}

#photoblog_header {
	width: 638px;
	margin-top: 10px;
}
    
	#photoblog_select {
		background: <?php echo $main_color; ?> repeat-x;
		border-radius: 5px;
		-moz-border-radius: 5px;
		-khtml-border-radius: 5px;
		padding: 3px 10px 5px;
		color: #fff;
		margin-bottom: 10px;
		width: 200px;
		position: absolute;
	}
		#photoblog_select_year, #photoblog_select_month {
			margin-right: 10px;
		}
		#photoblog_select_today {
			position: relative;
			top: 4px;
		}
	#photoblog_user_header {
		background: <?php echo $main_color; ?> repeat-x;
		border-radius: 5px;
		-moz-border-radius: 5px;
		-khtml-border-radius: 5px;
		padding: 5px 10px;
		color: <?php echo $detail_color; ?>;
		margin-bottom: 10px;
		margin-left: 230px;
		width: 388px;
		height: 20px;	
	}
	    
	    #photoblog_user_header.photoblog_user_header_ov a {
		margin: 0 5px;
	    }
	    
	#photoblog_user_header a {
		color: <?php echo $detail_color; ?>;
		margin: 0 14px;
		padding-top: 2px;
		display: block;
		float: left;
	}

#photoblog_thumbs {
    background: <?php echo $main_color; ?> repeat-x;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -khtml-border-radius: 5px;
    padding: 5px 10px 10px;
    color: #fff;
    position: relative;
    margin: 0 auto;
}

    #photoblog_thumbs_container {
        overflow: hidden;
        position: relative;
    }

	#photoblog_thumbs_inner {
	    width: 99999px;
	}

    div#photoblog_thumbs dl {
        position: relative;
        padding: 3px 0 0 0;
    }

    #photoblog_thumbs dl,
    #photoblog_thumbs dl * {
        margin: 0;
        padding: 0;
    }
	
        #photoblog_thumbs dt,
        #photoblog_thumbs dd {
            float: left;
            margin-right: 10px;
	    margin-bottom: 5px;
            color: <?php echo $contrast_color; ?>;
        }
	
		#photoblog_thumbs dt a {
		    color: <?php echo $detail_color; ?>;
		}
	
		#photoblog_thumbs dd a {
			display: block;
		}
    
            #photoblog_thumbs img {
                display: block;
		border: 2px solid transparent;
            }
		
		#photoblog_thumbs dt {
                    line-height: 38px;
                    margin-right: 10px;
                    font-size: 12px;
                    font-weight: bold;
		}
		
    #photoblog_thumbs dl {
        _height: 1%;
        *display: inline-block;
        _display: block;
    }

    #photoblog_thumbs dl:after {
        content: ".";
        display: block;
        height: 0;
        visibility: hidden;
        clear: both;
    }
	
    #photoblog_thumbs .photoblog_active img {
        border: 2px solid <?php echo $detail_color; ?>;
	-moz-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
    }


#photoblog_thumbs_scroller_outer {
    background: <?php echo $main_color; ?> url(http://images.hamsterpaj.net/photoblog/white-50-percent-opacity.png);
    height: 15px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
    margin-top: 7px;
    position: relative;
}

#photoblog_thumbs.hide_scroller #photoblog_thumbs_scroller_outer {
    display: none;
}

    #photoblog_thumbs.hide_scroller #photoblog_thumbs_container {
	overflow: visible;
    }
    
	#photoblog_thumbs.hide_scroller #photoblog_thumbs_inner {
	    width: auto;
	}
    
    #photoblog_scroller_toggle {
	position: absolute;
	bottom: 3px;
	left: 0px;
	width: 100%;
	height: 4px;
	background: #fff;
	display: block;
	overflow: hidden;
	text-indent: -10000px;
    }

    #photoblog_thumbs_scroller.ui-slider {
	position: relative;
	height: 15px;
    }

    #photoblog_thumbs_handle.ui-slider-handle {
        display: block;
        width: 40px;
        background: <?php echo $detail_color; ?> url(http://images.hamsterpaj.net/photoblog/scroller-overlay.png) repeat-x;
        -moz-border-radius: 4px;
    	-webkit-border-radius: 4px;
        height: 100%;
        cursor: pointer;
        position: absolute;
    }
	
#photoblog_image {
    /*width: 600px;*/
    margin: 10px auto;
    position: relative;
    background: #000;
    text-align: center;
    -moz-border-radius: 4px;
  	-webkit-border-radius: 4px;
}
	#photoblog_image p {
		margin: 0;
   	padding: 4px 0 2px 0;
	}

    #photoblog_next,
    #photoblog_prev {
        display: block;
        position: absolute;
        width: 50%;
        height: 100%;
        top: 0;
        left: 0;
        overflow: hidden;
        text-indent: -10000px;
	outline: none;
    }
	
    #photoblog_next {
        right: 0;
        left: auto;
        background: url(http://images.hamsterpaj.net/photoblog/next.png) right center no-repeat;
    }
    
    #photoblog_prev {
        background: url(http://images.hamsterpaj.net/photoblog/prev.png) left center no-repeat;
    }

#photoblog_nextmonth a,
#photoblog_prevmonth a {
	text-indent: -10000px;
	display: block;
	width: 8px;
	overflow: hidden;
	height: 38px;
	background: url(http://images.hamsterpaj.net/photoblog/nextprev-month.png) left center no-repeat;
}

#photoblog_nextmonth a {
	background-position: right center;
}

#photoblog_description {
	text-align: center;
}

    #photoblog_description h2 {
        text-align: center;
        margin: 0;
    }
    
#photoblog_loading {
	opacity: .6;
	filter: alpha(opacity=60);
	padding: 5px;
	background: #fff;
}

#photoblog_menu {
	background: url(http://images.hamsterpaj.net/photoblog/line-gradient.png) center bottom no-repeat;
	padding-bottom: 21px;
	text-align: center;
}

	#photoblog_menu li {
		display: inline;
	}

/* comments */
#photoblog_comments_list {
	margin-top: 10px;
	background: <?php echo $main_color; ?>;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	padding: 15px 15px 0 15px;
}
	#photoblog_comments_list ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
		.photoblog_comment {
			padding-bottom: 15px;
			clear: both;
		}
			.photoblog_comment_userinfo {
				float:left;
				margin-right: 15px;
				width: 75px;
			}
				.photoblog_comment .user_avatar {
					height: 100px;
					width: 75px;
				}
				.photoblog_comment_userinfo a {
					display: block;
					padding: 4px 0 2px 0;
					color: <?php echo $detail_color; ?>;
				}
				.photoblog_comment_userinfo span {
					display: block;
					color: #fff;
					opacity: .5;
					filter: alpha(opacity=50);
				}
			.photoblog_comment_bubble_pointer {
				width: 503px;
				padding: 0;
				background: url(http://images.hamsterpaj.net/photoblog/comment_bubble_pointer.png) no-repeat left top;
				float: left;
			}
			.photoblog_comment_text {
				background: #fff;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				width: 459px;
				padding: 15px;
				margin-left: 30px;
				min-height: 60px;
			}
				.photoblog_comment_text p {
					margin: 0;
				}	
				.photoblog_comment_answer {
					margin-top: 15px;
					border: 1px solid #d3d3d3;
					background: #eeeeee;
					padding: 10px;
					-moz-border-radius: 5px;
					-webkit-border-radius: 5px;
				}
					.photoblog_comment_answer span {
						color: #737272;
						margin-bottom: 8px;
						display: block;
					}
		
		#photoblog_comments_list .photoblog_comment_actions {
			text-align: right;
			padding: 0 10px;
			clear: both;
		}
		
		.photoblog_comment_actions li {
			display: inline;	
		}
		
		.photoblog_comment_actions li:after { content: " | "; }
		.photoblog_comment_actions li:last-child:after { content: ""; }
	
	#photoblog_comments h3 { display: none; }
	
	#photoblog_comments_form {
		margin-top: 10px;
		background: <?php echo $main_color; ?>;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		padding: 15px 15px 0 15px;
	}	
		#photoblog_comments_form ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}
	#photoblog_comments_form form,
	#photoblog_comments_form form * {
		margin: 0;
		padding: 0;
	}
	#photoblog_comments_form form textarea {
		width: 448px;
		border: none;
		margin: 0;
		padding: 0;
		font-size: 1.1em;
		font-family: tahoma,arial,"ms trebuchet",sans-serif,serif;
		color: #454545;
	}
	#photoblog_comments_form form .submit {
		border: 1px solid #c6c6c6;
		background: #e6e6e6;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
	}
	
/*
    ######################################################
	MODULER
    ######################################################

    ######################################################
	Photoblog_user
    ######################################################
*/

#ui_module_photoblog_user .ui_module_header {
  display: none;
}
	#ui_module_photoblog_user .ui_module_content {
	  padding: 10px;
	  height: 50px;
	  background: <?php echo $main_color; ?>;
	  color: #fff;
	  -moz-border-radius: 5px;
	}
	#ui_module_photoblog_user h3 {
	  margin:	0;
	  margin-left: 50px;
	  color: <?php echo $contrast_color; ?>
	}
	    #ui_module_photoblog_user h3 a {
		color: <?php echo $contrast_color; ?>;
	    }
	#ui_module_photoblog_user span a {
	  margin: 30px 0 0 50px;
	  text-decoration: underline;
	  color: <?php echo $detail_color; ?>;	
	  
	}
	#ui_module_photoblog_user .user_avatar {
	  position: absolute;
	  border: 1px solid gray;
	  width: 37px;
	  height: 50px;
	}

/*
	################################################################
		Photoblog_calendar
	################################################################
*/
#ui_module_photoblog_calendar .ui_module_header {
    /*display: none;*/
    background: <?php echo $main_color; ?>;
    -moz-border-radius: 5px;
    -moz-border-radius-bottomleft: 0;
    -moz-border-radius-bottomright: 0;
    -webkit-border-radius: 5px;
    -webkit-border-bottom-left-radius: 0;
    -webkit-border-bottom-right-radius: 0;
}
    
    #ui_module_photoblog_calendar .ui_module_header h2 {
	color: <?php echo $contrast_color; ?>;
    }

	#ui_module_photoblog_calendar .ui_module_content {
	    background: <?php echo $main_color; ?>;
	    color: #fff;
	    padding: 0;
	    -moz-border-radius-bottomleft: 5px;
	    -moz-border-radius-bottomright: 5px;
	    -webkit-border-bottom-left-radius: 5px;
	    -webkit-border-bottom-right-radius: 5px;
	}
	
		#photoblog_calendar_month span {
			color: <?php echo $contrast_color; ?>
		}
	
		#photoblog_calendar_month {
			padding: 8px 12px 16px 12px;
			height: 11px;
			font-size: 14px;
			text-align: center;
		}
			#photoblog_calendar_month a {
				color: <?php echo $detail_color; ?>;
			}	
		#ui_module_photoblog_calendar table {
		  margin: 0 11px;
		  width: 180px;
		  border: 1px inset #e1e1e1;
		  -moz-border-radius: 10px;
		  -webkit-border-radius: 10px;
		  border-radius: 10px;
		}
			#ui_module_photoblog_calendar th {
			  color: <?php echo $detail_color; ?>;
			  text-align: center;
			}
			#ui_module_photoblog_calendar td {
			  text-align: center;
			  height: 19px;
			  padding: 2px;
			  color: <?php echo $contrast_color; ?>;
			}
			#ui_module_photoblog_calendar td a {
			    font-weight: bold;
			    color: <?php echo $detail_color; ?>;
			}
			#photoblog_calendar_year {
				color: <?php echo $detail_color; ?>;
				padding: 10px 15px 0 15px;
				height: 25px;
			}
			    
			    #photoblog_calendar_year:after {
				clear: both;
				display: block;
				visibility: hidden;
				content: ".";
				height: 0;
			    }
			
				.photoblog_calendar_year_after {
					float: right;
					display: block;
					width: 40%;
					text-align: right;
				}
				.photoblog_calendar_year_pre {
					float: left;
					display: block;
					width: 40%;
				}

body #ui_module_photoblog_calendar td.photoblog_calendar_active {
	background: <?php echo $detail_color; ?>;
	font-weight: bold;
}

	#ui_module_photoblog_calendar td.photoblog_calendar_active a {
		color: <?php echo $main_color; ?>;
	}
	
#photoblog_calendar_year a { color: <?php echo $detail_color; ?>; }

/*
	################################################################
		Photoblog_albums
	################################################################
*/
#ui_modulebar #ui_module_photoblog_albums .ui_module_header {
    /*display: none;*/
    background: <?php echo $main_color; ?>;
    -moz-border-radius: 5px;
    -moz-border-radius-bottomleft: 0;
    -moz-border-radius-bottomright: 0;
    -webkit-border-radius: 5px;
    -webkit-border-bottom-left-radius: 0;
    -webkit-border-bottom-right-radius: 0;
}

    #ui_module_photoblog_albums .ui_module_header h2 {
	color: <?php echo $contrast_color; ?>;
    }

	#ui_module_photoblog_albums .ui_module_content {
	    padding: 0 10px 10px;
	    background: <?php echo $main_color; ?>;
	    color: #fff;
	    -moz-border-radius-bottomleft: 5px;
	    -moz-border-radius-bottomright: 5px;
	    -webkit-border-bottom-left-radius: 5px;
	    -webkit-border-bottom-right-radius: 5px;
	}
	#ui_module_photoblog_albums .ui_module_content h2 {
	    margin: 0;
	    padding: 0;
	    text-indent: 0;
	    text-align: center;
	    display: none;
	}
	    #ui_module_photoblog_albums h2 a {
		color: <?php echo $contrast_color; ?>;
		font-size: 14px;
		font-weight: normal;
	    }
	    
	#ui_module_photoblog_albums a h3 {
		margin-top: 8px;
		font-weight: normal;
		float: left;
		width: 100px;
	}
	#ui_module_photoblog_albums .photoblog_album_module_link {
	    display: block;
	    color: <?php echo $detail_color; ?>;
	}
	
	#ui_module_photoblog_albums img {
	    margin: 10px 10px 0 0;
	    -moz-border-radius: 4px;
	    -webkit-border-radius: 4px;
	    border: 2px solid white;
	    width: 50px;
	    float: left;
	}

/*
    Editing
*/

#photoblog_edit {
    text-align: left;
}

    #photoblog_edit_do {
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
	background: <?php echo $main_color; ?>;
	padding: 10px;
	margin-top: 10px;
	color: <?php echo $detail_color; ?>;
    }
    
	#photoblog_edit h3, #photoblog_edit h4 {
	    margin: 0;
	    padding: 0;
	}
	
	#photoblog_edit h3 a {
	    font-weight: normal;
	    color: <?php echo $detail_color; ?>;
	}
    
    #photoblog_edit_description {
	float: left;
	margin-right: 10px;
    }
    
    #photoblog_edit_date {
	float: left;
    }
    
    #photoblog_edit_save {
	float: left;
	margin: 0;
    }
    
	#photoblog_edit_save input {
	    display: block;
	    margin-bottom: 4px;
	}
    
    #photoblog_edit_do:after {
	clear: both;
	content: ".";
	visibility: hidden;
	height: 0;
	display: block;
    }

#photoblog_sort {
	background: <?php echo $main_color; ?>;
	padding: 10px;
	color: <?php echo $detail_color; ?>;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
}

    #photoblog_sort a {
	color: <?php echo $contrast_color; ?>;
    }

#photoblog_sort ul {
	clear: both;
	background: #fff;
	padding: 10px;
	margin: 10px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
}

	#photoblog_sort li {
		float: left;
		padding: 5px;
		list-style: none;
		text-align: center;
		cursor: move;
	}
	
		#photoblog_sort img {
			border: 2px solid <?php echo $main_color; ?>;
		}
	
		#photoblog_sort li input {
			position: relative;
			z-index: 5;
		}
	
	#photoblog_sort ul:after {
		clear: both;
		display: block;
		content: ".";
		visibility: hidden;
		height: 0;
	}
	
	.sort-ghost {
		opacity: .6;
		filter: alpha(opacity=60);
		cursor: move;
	}
	
	.sort-active {
		visibility: hidden;
	}
	
	.jquery_sort_graveyard  {
		list-style: none;
	}

.__htmlpopup {
	border: 1px solid #999;
	margin: 0;
	padding: 10px;
	background: <?php echo $main_color; ?>;
	color: <?php echo $contrast_color; ?>;
}

	.__htmlpopup * { margin: 0; padding: 0; }
	
	.__htmlpopup textarea {
		border: 0;
		background: #fff;
		color: #000;
		padding: 5px;
	}

a.report_abuse {
	display: block;
	float: right;
	width: 11px;
	height: 20px;
	background: url(http://images.hamsterpaj.net/abuse.png) no-repeat;
	text-indent: -10000px;
	overflow: hidden;
}

.photoblog_photo_info,
.photoblog_upload_container {
	border: 1px solid <?php echo $detail_color; ?>;
	background: <?php echo $main_color; ?>;
	color: <?php echo $contrast_color; ?>;
	padding: 2em 0;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
}

    .photoblog_upload_container div {
	margin: 0 auto;
	width: 400px;
    }
    
    .photoblog_upload_container select {
	width: 100px;
    }

    .photoblog_upload_container h3 {
	    margin: 0;
    }
    
    .photoblog_upload_container p {
	    margin-top: 5px;
	    margin-bottom: 0;
    }
    
    .photoblog_loading { opacity: 0.5; }
    
    .photoblog_load {
	position: absolute;
	top: 48%;
	left: 48%;
    }
    
    .photoblog_upload_or {
	padding-right: 4px;
    }
    
    .photoblog_photo_info input[maxlength="4"],
    .photoblog_upload_container input[maxlength="4"] {
	width: 40px;
    }
    
    .photoblog_photo_info input[maxlength="2"],
    .photoblog_upload_container input[maxlength="2"] {
	width: 20px;
    }
    
    .photoblog_photo_info {
	width: 40%;
	margin: 1%;
	padding: 2% 3%;
	float: left;
	position: relative;
    }
    
	.photoblog_submit_info {
	    text-align: center;
	    margin: 0 auto;
	    float: none;
	    border: 1px solid <?php echo $main_color; ?>;
	    background: <?php echo $detail_color; ?>;
	}
	    .photoblog_submit_info input {
		width: 70%;
	    }
	    
	.photoblog_photo_info h3 {
	    text-align: center;
	    margin: 0;
	}
    
	.photoblog_upload_cancel {
	    position: absolute;
	    top: -10px;
	    right: -10px;
	    width: 20px;
	    height: 20px;
	    text-align: center;
	    color: #fff;
	    padding-top: 4px;
	    overflow: hidden;
	    display: block;
	    background: #999;
	}

.photoblog_ie_warning {
    border: 1px solid red;
    background: pink;
    margin: 10px;
    padding: 10px;
}

    .photoblog_ie_warning * { margin: 0; padding: 0; }

#photoblog_admin_all ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

    #photoblog_admin_all ul:after {
	content: ".";
	clear: both;
	height: 0;
	visibility: hidden;
	display: block;
    }

    #photoblog_admin_all li {
	border: 1px solid #999;
	margin: 1%;
	padding: 5px;
	position: relative;
	min-height: 39px;
	float: left;
	width: 46%;
    }
    
	#photoblog_admin_all li.active {
	    width: 96%;
	}
	
	#photoblog_admin_all textarea {
	    width: 80%;
	}
    
	#photoblog_admin_all img {
	    position: absolute;
	    right: 5px;
	    top: 5px;
	}
	
	#photoblog_admin_all .photoblog_info {
	    border: 1px solid #e1e1e1;
	    width: 90%;
	    position: relative;
	    background: #fff;
	}
	
	#photoblog_admin_all .photoblog_info p {
	    margin: 10px;
	    padding: 0px;
	}
	
	#photoblog_admin_all .remove {
	    position: absolute;
	    bottom: 10px;
	    right: 10px;
	}