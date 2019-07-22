"use strict"

function insertValue(row, col_1, col_2, type_message, media_type, session_name) {
    for (let i = 0; i < 3; i++){
        const cell = row.insertCell(i);
        switch (i) {
            case 0:
                if (col_1 != session_name){
                    cell.setAttribute('class', 'sender');
                    cell.innerHTML = col_1;
                }
                break;
            case 1:
                switch (type_message) {
                    case 'text':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = col_2;
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = col_2;
                        }
                        break;
                    case 'media':
                        switch (media_type) {
                            case '1':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                break;
                            case '2':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "<video class='video' controls='controls'> <source src=" + col_2 + "> </video>";
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "<video class='video' controls='controls'> <source src=" + col_2 + "> </video>";
                                }
                        }
                        break;
                    case 'raven_media':
                        switch (media_type) {
                            case '1':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                                    //cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                                    //cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                break;
                            case '2':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_2 + "> </video>";
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_2 + "> </video>";
                                }
                        }
                        break;
                    case 'voice_media':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "<i> Голосовое сообщение </i> </br> <audio controls='controls'> <source src=" + col_2 + "> </audio>";
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "<i> Голосовое сообщение </i> </br> <audio controls='controls'> <source src=" + col_2 + "> </audio>";
                        }
                        break;
                    case 'like':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2;
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2;
                        }
                        break;
                    case 'media_share':
                        switch (media_type) {
                            case '1':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='image' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                }
                                break;
                            case '2':
                                if (col_1 != session_name){
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_2 + "> </video>";
                                }
                                if (col_1 == session_name){
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_2 + "> </video>";
                                }
                                break;
                            case '8':
                                if (col_1 != session_name){
                                    /*  cell.setAttribute('class', 'message-sender');
                                      var image = "<div id=\"carousel\" class=\"carousel\">";
                                      image += "<button class=\"arrow prev\"> ⇦ </button>";
                                      image += "<div class=\"gallery\">";
                                      image += "<ul class=\"images\">";

                                      for (let j = 0; j < col_2.length; j++)
                                      {
                                          image += "<li> <a href=" + col_2[j] + " target='_blank' > <img src=" + col_2[j] + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a> </li>"
                                      }
                                      image += "</ul>";
                                      image += "</div>";
                                      image += "<button class=\"arrow next\"> ⇨ </button>";
                                      image += "</div>";
                                      cell.innerHTML = image;*/
                                    cell.setAttribute('class', 'message-sender');
                                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                                }
                                if (col_1 == session_name){
                                    /*cell.setAttribute('class', 'message-recipient');
                                    var image = "<div id=\"carousel\" class=\"carousel\">";
                                    image += "<button class=\"arrow prev\"> ⇦ </button>";
                                    image += "<div class=\"gallery\">";
                                    image += "<ul class=\"images\">";

                                    for (let j = 0; j < col_2.length; j++)
                                    {
                                        image += "<li> <a href=" + col_2[j] + " target='_blank' > <img class='image' src=" + col_2[j] + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a> </li>"
                                    }
                                    image += "</ul>";
                                    image += "</div>";
                                    image += "<button class=\"arrow next\"> ⇨ </button>";
                                    image += "</div>";
                                    cell.innerHTML = image;*/
                                    cell.setAttribute('class', 'message-recipient');
                                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                                }
                                break;
                        }
                        break;
                    case 'link':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2 + type_message;
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2 + type_message;
                        }
                        break;
                    case 'video_call_event':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "<i>" +  col_2 + "</i>";
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "<i>" +  col_2 + "</i>";
                        }
                        break;
                    case 'animated_media':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='gif' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "<a href=" + col_2 + " target='_blank' > <img class='gif' src=" + col_2 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                        }
                        break;
                    case 'action_log':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = col_2;
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = col_2;
                        }
                    case 'reel_share':
                        if (col_1 != session_name){
                            cell.setAttribute('class', 'message-sender');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2;
                        }
                        if (col_1 == session_name){
                            cell.setAttribute('class', 'message-recipient');
                            cell.innerHTML = "В текущей версии просмотр недоступен!";
                            //cell.innerHTML = col_2;
                        }
                        break;
                }
                break;
            default:
                if (col_1 != session_name){
                    cell.setAttribute('class', 'message-sender');
                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                }
                if (col_1 == session_name){
                    cell.setAttribute('class', 'message-recipient');
                    cell.innerHTML = "В текущей версии просмотр недоступен!";
                }
                break;
            case 2:
                if (col_1 == session_name){
                    cell.setAttribute('class', 'recipient');
                    cell.innerHTML = col_1;
                }
                break;
                break;
        }
    }
}

const tableDiv = document.getElementById('divTable');

const table = document.createElement('table');

table.setAttribute('class', 'message');

for (let i = 0; i < count_dialog; i++ ){
    const row = table.insertRow(i);

    insertValue(row, message_sender_name[i], message[i], message_type[i], message_media_type[i], session_name);
}

tableDiv.appendChild(table);