import moment from "moment";

//Funcão para extrair a hora de um datetime
function time(date) {
    return (moment(date).format('hh:mm:ss'));
}

//Funcão para formatar para a data padrao pt-br
function date(date) {
    return (moment(date).format('DD/MM/YYYY '));
}

//Funcão para formatar data e hora
function datetime(date) {
    return (moment(date).format('DD/MM/YYYY h:mm:ss'));
}

export {date, time, datetime}


