@extends('layouts.app')

@section('content')
				<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
					<link rel="shortcut icon" href="https://quickblox.com/favicon.ico">

							    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
							    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
							    <link rel="stylesheet" href="../css/style.css">

							    <script src="https://unpkg.com/navigo@4.3.6/lib/navigo.min.js" defer></script>
							    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js" defer></script>
							    <script src="../quickblox.min.js" defer></script>
            <div class="panel panel-default">
                <div class="row">
				  <div class="col-sm-5">
				  		<ul class="nav nav-pills" style="max-width: 300px;">
				  		<br>
	  						<li class="nav-item"><a class="nav-link chat1 " href="#chat">Chat</a></li>
	  						<li class="nav-item"><a class="nav-link" href="javascript:void(0)">Videochat</a></li><br>
	  						<br>
						</ul>
						<div id="chat" class="oculto2">
										
							            <div class="panel panel-default">
							                	<div id="page"></div>

							    <!-- Underscore templates  -->
							    <script type="text/template" id="tpl_login">
							        <div class="login__wrapper">
							            <div class="login__container">
							                <div class="login__inner">
							                    <div class="login__top">
							                        <h1>Universitaria Agustiniana Uniagustiniana</h1>
							                    </div>

							                    <form name="loginForm" class="login__form">
							                        <div class="login_form__row">
							                            <input type="text" id="userName" name="userName" value="{{ Auth::user()->name }}" disabled />
							                        </div>
							                        <div class="login_form__row">
							                            <input type="text" id="userGroup" name="userGroup" value="Uniagustiniana" disabled/>
							                        </div>
							                        <div class="login__button_wrap">
							                            <button type="submit" name="login_submit" class="btn m-login__button j-login__button">
							                                Empieza a chatear!!
							                            </button>
							                        </div>
							                    </form>
							                </div>
							                <div class="login__footer">
							                    <div class="footer__logo_wrap">
							                        <a href="https://quickblox.com/" class="footer__logo">
							                            <img src="../img/qblogo-grey.svg" alt="QuickBlox">
							                        </a>
							                        <p>by QuickBlox</p>
							                    </div>	
							                </div>
							            </div>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_dashboardContainer">
							        <div class="dashboard">
							            <div class="sidebar j-sidebar active">
							                <div class="sidebar__inner">
							                    <div class="sidebar__header">
							                        <div class="dashboard__status_wrap">
							                            <h2 class="dashboard__title"><%- user.user_tags %></h2>
							                            <p class="dashboard__status j-dashboard_status">
							                                Logeado como <%- user.name %>
							                            </p>
							                        </div>
							                        <a href="#" class="logout j-logout">logout</a>
							                    </div>
							                    <div class="sidebar__content">
							                        <ul class="sidebar__tabs">
							                            <li class="sidebar__tab">
							                                <a href="#" class="sidebar__tab_link j-sidebar__tab_link <% tabName === "chat" ? print('active') : '' %>" data-type="chat">chats</a>
							                            </li>
							                            <li class="sidebar__tab">
							                                <a href="#" class="sidebar__tab_link j-sidebar__tab_link <% tabName === "public" ? print('active') : '' %>" data-type="public">Chats publicos</a>
							                            </li>
							                            <li class="sidebar__tab m-sidebar__tab_new">
							                                <a href="#!/dialog/create" class="sidebar__tab_link j-sidebar__create_dialog m-sidebar__tab_link_new" data-type="create">
							                                    <i class="material-icons">add_circle_outline</i>
							                                </a>
							                            </li>
							                        </ul>
							                        <ul class="sidebar__dilog_list j-sidebar__dilog_list">
							                        </ul>
							                    </div>
							                </div>
							            </div>
							            <div class="content j-content">
							            </div>
							        </div>
							    </script>

							    <script  type="text/template" id="tpl_welcome">
							        <div class="content__title j-content__title j-welcome">
							            Welcome to QuickBlox chat sample!
							        </div>
							        <div class="notifications j-notifications hidden"></div>
							        <div class="content__inner j-content__inner">
							            <div class="welcome__message">
							                <p>Please select you opponent to start chatting.</p>
							            </div>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_userConversations">
							        <li class="dialog__item j-dialog__item" id="<%= dialog._id %>" data-name="<%- dialog.name %>">
							            <a class="dialog__item_link" href="#!/dialog/<%= dialog._id %>">
							                <span class="dialog__avatar m-user__img_<%= dialog.color %> m-type_<%= dialog.type === 2 ? 'group' : 'chat' %>" >
							                    <% if(dialog.type === 2) { %>
							                        <i class="material-icons">supervisor_account</i>
							                    <% } else { %>
							                        <i class="material-icons">account_circle</i>
							                    <% } %>
							                </span>
							                <span class="dialog__info">
							                    <span class="dialog__name"><%- dialog.name %></span>
							                    <span class="dialog__last_message j-dialog__last_message <%= dialog.attachment ? 'attachment' : ''%>"><%- dialog.last_message%></span>
							                </span>
							                <span class="dialog_additional_info">
							                    <span class="dialog__last_message_date j-dialog__last_message_date">
							                        <%= dialog.last_message_date_sent %>
							                    </span>
							                    <span class="dialog_unread_counter j-dialog_unread_counter <% !dialog.unread_messages_count ? print('hidden') : '' %>">
							                        <% dialog.unread_messages_count ? print(dialog.unread_messages_count) : '' %>
							                    </span>
							                </span>
							            </a>
							        </li>
							    </script>

							    <script type="text/template" id="tpl_conversationContainer">
							        <div class="content__title j-content__title j-dialog">
							            <button class="open_sidebar j-open_sidebar"></button>
							            <h1 class="dialog__title j-dialog__title"><%- title %></h1>
							            <div class="action_links">
							                <a href="#!/dialog/<%- _id %>/edit" class="add_to_dialog j-add_to_dialog <% type !== 2 ? print('hidden') : ''%>"><i class="material-icons">person_add</i></a>
							                <a href="#" class="quit_fom_dialog_link j-quit_fom_dialog_link <% type === 1 ? print('hidden') : ''%>"><i class="material-icons">delete</i></a>
							            </div>
							        </div>
							        <div class="notifications j-notifications hidden"></div>
							        <div class="content__inner j-content__inner">
							            <div class=" messages j-messages"></div>
							            <form name="send_message" class="send_message" autocomplete="off">
							                    <textarea name="message_feald" class="message_feald" id="message_feald" autocomplete="off"
							                              autocorrect="off" autocapitalize="off" placeholder="Type a message" autofocus></textarea>
							                <div class="message__actions">
							                    <div class="attachments_preview j-attachments_preview"></div>
							                    <label for="attach_btn" class="attach_btn">
							                        <i class="material-icons">attachment</i>
							                        <input type="file" id="attach_btn" name="attach_file" class="attach_input" accept="image/*"/>
							                    </label>
							                    <button class="send_btn">Enviar</button>
							                </div>
							            </form>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_UpdateDialogContainer">
							        <div class="content__title j-content__title update_dialog__header j-update_dialog">
							            <a href="#!/dialog/<%- _id %>" class="back_to_dialog j-back_to_dialog">
							                <i class="material-icons">arrow_back</i>
							            </a>
							            <form action="#" name="update_chat_name" class="update_chat_name_form">
							                <input type="text" name="update_chat__title" class="update_chat__title_input j-update_chat__title_input" value="<%- title %>" disabled>
							                <button type="button" class="update_chat__title_button j-update_chat__title_button">
							                    <i class="material-icons m-user_icon">create</i>
							                </button>
							            </form>
							        </div>
							        <div class="notifications j-notifications hidden"></div>
							        <div class="content__inner j-content__inner">
							            <p class="update__chat__description"><span class="update__chat_counter j-update__chat_counter">0</span>&nbsp;user selected:</p>
							            <div class="update_chat__user_list j-update_chat__user_list">
							            </div>
							            <form action="" name="update_dialog" class="dialog_form m_dialog_form_update j-update_dialog_form">
							                <button type="button" class="btn m-update_dialog_btn_cancel j-update_dialog_btn_cancel" name="update_dialog_cancel">cancel</button>
							                <button class="btn m-update_dialog_btn j-update_dialog_btn"  type="submit" name="update_dialog_submit" disabled>add member</button>
							            </form>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_editChatUser">
							        <div class="user__item <% selected ? print('disabled selected') : ''%>" id="<%= id %>">
							            <span class="user__avatar m-user__img_<%= color %>">
							                <i class="material-icons m-user_icon">account_circle</i>
							            </span>
							            <div class="user__details">
							                <p class="user__name"><%= name %></p>
							                <% if (last_request_at) { %>
							                <p class="user__last_seen"><%= last_request_at %></p>
							                <% } %>
							            </div>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_message">
							        <div class="message__wrap" id="<%= message.id %>" data-status="<%= message.status %>">
							            <span class="message__avatar m-user__img_<%= sender ? sender.color : 'not_loaded' %>">
							                <i class="material-icons">account_circle</i>
							            </span>
							            <div class="message__content">
							                <div class="message__sender_and_status">
							                    <p class="message__sender_name"><%- sender ? sender.name : 'unknown user (' + message.sender_id + ')' %></p>
							                    <p class="message__status j-message__status"><%= message.status %></p>
							                </div>
							                <div class="message__text_and_date">
							                    <div class="message__text_wrap">
							                        <% if (message.message) { %>
							                        <p class="message__text"><%= message.message %></p>
							                        <% } %>
							                        <% if (message.attachments.length) { %>
							                        <div class="message__attachments_wtap">
							                            <% _.each(message.attachments, function(attachment){ %>
							                            <img src="<%= attachment.src %>" alt="attachment" class="message_attachment">
							                            <% }); %>
							                        </div>
							                        <% } %>
							                    </div>
							                    <div class="message__timestamp">
							                        <%= message.date_sent %>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_notificationMessage">
							        <div class="message__wrap m-notification_message" id="<%= _id %>">
							            <%= message || body %>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_newGroupChat">
							        <div class="content__title j-content__title j-create_dialog">
							            <button class="back_to_dialog j-back_to_dialog">
							                <i class="material-icons">arrow_back</i>
							            </button>
							            <h1 class="group_chat__title">New Group Chat</h1>
							        </div>
							        <div class="notifications j-notifications hidden"></div>
							        <div class="content__inner j-content__inner">
							            <p class="group__chat__description">Select participants:</p>
							            <div class="group_chat__user_list j-group_chat__user_list">
							            </div>
							            <form action="" name="create_dialog" class="dialog_form m-dialog_form_create j-create_dialog_form">
							                <input class="dialog_name" name="dialog_name" type="text"  autocomplete="off"
							                       autocorrect="off" autocapitalize="off" placeholder="Add conversation name" disabled>
							                <button class="btn m-create_dialog_btn j-create_dialog_btn"  type="submit" name="create_dialog_submit" disabled>create</button>
							            </form>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_newGroupChatUser">
							        <div class="user__item <% user.selected ? print('disabled selected') : ''%>" id="<%= user.id %>">
							            <span class="user__avatar m-user__img_<%= user.color %>">
							                <i class="material-icons m-user_icon">account_circle</i>
							            </span>
							            <div class="user__details">
							                <p class="user__name"><%- user.name %></p>
							                <% if (user.last_request_at) { %>
							                <p class="user__last_seen"><%= user.last_request_at %></p>
							                <% } %>
							            </div>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_message__typing">
							        <div class="message__wrap m-typing j-istyping" id="is__typing">
							            <% _.each(users, function(user){  %>
							                <span class="message__avatar <%- typeof user === 'number' ? 'm-typing_unknown m-typing_' + user : 'm-user__img_' + user.color %>">
							                    <i class="material-icons">account_circle</i>
							                </span>
							            <% }); %>
							            <% if (users.length){ %>
							            <div id="fountainG">
							                <div id="fountainG_1" class="fountainG"></div>
							                <div id="fountainG_2" class="fountainG"></div>
							                <div id="fountainG_3" class="fountainG"></div>
							            </div>
							            <% } %>
							        </div>
							    </script>

							    <script type="text/template" id="tpl_attachmentPreview">
							        <div class="attachment_preview__wrap m-loading" id="<%= id %>">
							            <img class="attachment_preview__item" src="<%= src %>">
							        </div>
							    </script>

							    <script type="text/template" id="tpl_attachmentLoadError">
							        <p class="attachment__error">Can't load attachment...</p>
							    </script>

							    <script type="text/template" id="tpl_lost_connection">
							        <div class="titile">Waiting for network.</div>
							        <div class="spinner"><img src="../img/loader2.gif" alt="wating"></div>
							    </script>

							    <script type="text/template" id="tpl_loading">
							        <div class="loading__wrapper">
							            <div class="loading_inner">
							                <img class="loading__logo" src="../img/qb-logo.svg" alt="QB_logo">
							                <p class="loading__description">Cargando...</p>
							            </div>
							        </div>
							    </script>

       						 </div>
						</div>
				  </div>

				   <script type="text/javascript">
					jQuery(document).ready(function(){
					$(".oculto2").hide();              
					$(".chat1").click(function(){
					      var nodo = $(this).attr("href");  

					      if ($(nodo).is(":visible")){
					           $(nodo).hide();
					           return false;
					      }else{
					    $(".oculto2").hide("slow");                             
					    $(nodo).fadeToggle("fast");
					    return false;
					      }
					});
					}); 
					</script>

				  <div class="col-sm-7">
				  		<ul class="nav nav-pills">
				  		<br>
				  			<li class="nav-item"><a href="#info1" class="nav-link inf">Media Aritmetica</a></li>
	  						<li class="nav-item"><a href="#info2" class="nav-link inf">Media Geometrica</a></li>
	  						<li class="nav-item"><a href="#info3" class="nav-link inf">Media Ponderada</a></li>
				  		</ul>	<br><br>			
						<div id="info1" class="oculto">
							<c><embed src="actividades/Media_Aritmetica.pdf" width="800" height="700"></c>
						</div>
						<div id="info2" class="oculto">
							<c><embed src="actividades/Media_Geometrica.pdf" width="800" height="700"></c>
						</div>
						<div id="info3" class="oculto">
							<c><embed src="actividades/Media_Ponderada.pdf" width="800" height="700"></c>
						</div>
				  
				  <script type="text/javascript">
					jQuery(document).ready(function(){
					$(".oculto").hide();              
					$(".inf").click(function(){
					      var nodo = $(this).attr("href");  

					      if ($(nodo).is(":visible")){
					           $(nodo).hide();
					           return false;
					      }else{
					    $(".oculto").hide("slow");                             
					    $(nodo).fadeToggle("fast");
					    return false;
					      }
					});
					}); 
					</script>
				  </div>
				</div>
            </div>
        </div>


	    <script src="../js/QBconfig.js" defer></script>
	    <script src="../js/user.js" defer></script>
	    <script src="../js/dialog.js" defer></script>
	    <script src="../js/message.js" defer></script>
	    <script src="../js/listeners.js" defer></script>
	    <script src="../js/helpers.js" defer></script>
	    <script src="../js/app2.js" defer></script>
	    <script src="../js/login.js" defer></script>
	    <script src="../js/route.js" defer></script>
@endsection