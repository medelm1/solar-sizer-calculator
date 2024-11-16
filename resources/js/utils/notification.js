import { useToast, TYPE, POSITION } from "vue-toastification";

const toast = useToast();

const notify = (message, type) => {
    toast(message, {
        type,
        position: POSITION.TOP_CENTER,
        timeout: 3000,
        draggable: true,
        closeOnClick: true,
    });
};

const notification = {
    success(message) {
        notify(message, TYPE.SUCCESS);
    },
    error(message) {
        notify(message, TYPE.ERROR);
    },
    info(message) {
        notify(message, TYPE.INFO);
    },
    warning(message) {
        notify(message, TYPE.WARNING);
    },
    default(message) {
        notify(message, TYPE.DEFAULT);
    },
};

export default notification;
