import axios from "axios";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime);
export function timeStamp(date) {
    var o = dayjs(date, "YYYY-MM-DD hh:mm:ss").format("DD/MM/YYYY h:mm a");
    if (o == "30/11/1899 12:00 am") {
        return "NULL";
    } else {
        return o;
    }
}
export function dateStamp(date) {
    var o = dayjs(date, "YYYY-MM-DD hh:mm:ss").format("DD MMM YYYY");
    if (o == "30 Nov 1899") {
        return "NULL";
    } else {
        return o;
    }
}
export function timeForHumans(date) {
    return dayjs(date, "YYYY-MM-DD hh:mm:ss").fromNow();
}
