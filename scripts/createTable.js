"use strict"

function insertHead(row, col_1, col_2, col_3, col_4, col_5) {
    for (let i = 0; i < 5; i++){
        const cell = row.insertCell(i);
        switch (i) {
            case 0:
                cell.outerHTML = "<th>" + col_1 + "</th>";
                break;
            case 1:
                cell.outerHTML = "<th>" + col_2 + "</th>";
                break;
            case 2:
                cell.outerHTML = "<th>" + col_3 + "</th>";
                break;
            case 3:
                cell.outerHTML = "<th>" + col_4 + "</th>";
                break;
            case 4:
                cell.outerHTML = "<th>" + col_5 + "</th>";
                break;
        }
    }
}

function insertValue(row, col_1, col_2, col_3, col_4, col_5, message_type, media_type) {
    for (let i = 0; i < 5; i++){
        const cell = row.insertCell(i);
        switch (i) {
            case 0:
                cell.innerHTML = col_1;
                break;
            case 1:
                cell.innerHTML = col_2;
                break;
            case 2:
                switch (message_type) {
                    case 'text':
                        cell.innerHTML = col_3;
                        break;
                    case 'media':
                        switch (media_type) {
                            case '1':
                                cell.innerHTML = "<a href=" + col_3 + " target='_blank' > <img class='image' src=" + col_3 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                break;
                            case '2':
                                cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_3 + "> </video>";
                                break;
                        }
                        break;
                    case 'raven_media':
                        switch (media_type) {
                            case '1':
                                cell.innerHTML = "В текущей версии просмотр недоступен!";
                                //cell.innerHTML = "<a href=" + col_3 + " target='_blank' > <img class='image' src=" + col_3 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                break;
                            case '2':
                                cell.innerHTML = "В текущей версии просмотр недоступен!";
                                //cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_3 + "> </video>";
                                break;
                        }
                        break;
                    case 'voice_media':
                        cell.innerHTML = "<i> Голосовое сообщение </i> </br> <audio controls='controls'> <source src=" + col_3 + "> </audio>";
                        break;
                    case 'like':
                        cell.innerHTML = "В текущей версии просмотр недоступен!";
                        //cell.innerHTML = col_3;
                        break;
                    case 'media_share':
                        switch (media_type) {
                            case '1':
                                cell.innerHTML = "<a href=" + col_3 + " target='_blank' > <img class='image' src=" + col_3 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                                break;
                            case '2':
                                cell.innerHTML = "<video class='video' controls='controls' width='100' height='200'> <source src=" + col_3 + "> </video>";
                                break;
                            case '8':
                                cell.innerHTML = "В текущей версии просмотр недоступен!";
                                break;
                        }
                        break;
                    case 'link':
                        cell.innerHTML = col_3 + message_type;
                        break;
                    case 'video_call_event':
                        cell.innerHTML = "<i>" +  col_3 + "</i>";
                        break;
                    case 'animated_media':
                        cell.innerHTML = "<a href=" + col_3 + " target='_blank' > <img class='gif' src=" + col_3 + " width='100' height='200' title='Нажмите на картинку, для просмотра в полном размере'> </a>"
                        break;
                    case 'action_log':
                        cell.innerHTML = col_3;
                        break;
                    case 'reel_share':
                        cell.innerHTML = "В текущей версии просмотр недоступен!";
                        //cell.innerHTML = col_3;
                        break;
                    default:
                        cell.innerHTML = "В текущей версии просмотр недоступен!";
                        break;
                }
                break;
            case 3:
                cell.innerHTML = col_4;
                break;
            case 4:
                cell.innerHTML = "<form action='thread.php' method='POST'> <button class='but-show but-cursor' value='" + col_5 + "' name='button'> Открыть </button> </form> </td>";
                break;
        }
    }
}

const tableDiv = document.getElementById('divTable');

const table = document.createElement('table');

table.setAttribute('class', 'article');

const row = table.insertRow(0);
insertHead(row, '№', 'Название','Последнее сообщение','Отправитель','Перейти в диалог');

for (let i = 0; i < count_dialog; i++ ){
    const row = table.insertRow(i + 1);
    insertValue(row, i + 1, thread_title[i], message[i], message_sender_name[i], thread_id[i], message_type[i], message_media_type[i]);
}

tableDiv.appendChild(table);