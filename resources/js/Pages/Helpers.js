import axios from "axios";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
dayjs.extend(relativeTime);
export function timeStamp(date) {
    return dayjs(date, "YYYY-MM-DD hh:mm:ss").format("DD/MM/YYYY h:mm a");
}
export function timeForHumans(date) {
    return dayjs(date, "YYYY-MM-DD hh:mm:ss").fromNow();
}
