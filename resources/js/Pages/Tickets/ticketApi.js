import axios from "axios";
export function saveTicket() {
    let ticket = this.$page.props.ticket;

    axios
        .post("/ticket/update/" + ticket.id, {
            ticket: ticket,
        })
        .then((response) => {
            console.log(response.data.message);
        })
        .catch((error) => {
            console.log(error);
        });
}
export function reassignTicket(id) {
    let ticket = this.$page.props.ticket;

    axios
        .post("/ticket/reassign/" + ticket.id, {
            new_user_id: id,
        })
        .then((response) => {
            console.log(response.data.message);
        })
        .catch((error) => {
            console.log(error);
        });
}
export function closeTicket(id) {
    axios
        .post("/ticket/close/" + id)
        .then((response) => {
            console.log(response.data.message);
        })
        .catch((error) => {
            console.log(error);
        });
}
export function openTicket(id) {
    axios
        .post("/ticket/open/" + id)
        .then((response) => {
            console.log(response.data.message);
        })
        .catch((error) => {
            console.log(error);
        });
}
export function fetchUserTenancy() {
    axios
        .post("/ticket/api/getUserTenancies", {
            id: this.user.UserID,
        })
        .then((response) => {
            console.log(response.data);
            this.user.tenancies = response.data.tcy;
            this.saveTicket();
        })
        .catch((error) => {
            console.log(error);
            // $emit("failed", error);
        });
}
export function fetchPropertyTenancies() {
    let ids = this.property.TenantIDs.split(",");
    console.log(ids);
    this.property.tenancies = [];
    ids.forEach((e) => {
        console.log("getting tenancy for " + e);
        axios
            .post("/ticket/api/getUserTenancies", {
                id: e,
            })
            .then((response) => {
                let tar = response.data.tcy[0];
                console.log();
                if (tar !== 0) {
                    this.property.tenancies.push(response.data.tcy[0]);
                } else {
                    console.log("tenancy not retrieved");
                }
            })
            .catch((error) => {
                console.log(error);
                // $emit("failed", error);
            });
    });
    this.saveTicket();
}
export function fetchProperty() {
    axios
        .post("/ticket/api/getProperties", {
            user_id: this.user.UserID,
        })
        .then((response) => {
            console.log(response.data.data);
            this.user.properties = response.data.pty;
            this.saveTicket();
        })
        .catch((error) => {
            console.log(error);
            // $emit("failed", error);
        });
}
export function addTask() {
    console.log("adding task");
    console.log(this.$page.props.ticket);
    let $task = {
        title: "",
        is_complete: false,
    };
    if (this.$page.props.ticket.tasks !== null) {
        this.$page.props.ticket.tasks.push($task);
    } else {
        this.$page.props.ticket.tasks = [];
        this.$page.props.ticket.tasks.push($task);
    }

    console.log(this.$page.props.ticket.tasks);
}
export function saveTask(task, index) {
    if (task.title == "") {
        console.log("Dropping empty task " + index);
        this.$page.props.ticket.tasks.splice(index, 1);
    }
    this.saveTicket(this.$page.props.ticket);
}

export function addUser(u) {
    console.log("addUser fired");

    console.log(u);
    if (this.$page.props.ticket.users == null) {
        this.$page.props.ticket.users = [];
    }
    if (u !== null) {
        this.$page.props.ticket.users.push(u);
    }
    this.saveTicket(this.$page.props.ticket);
}
export function dropUser(user) {
    console.log(user);
    let index = this.$page.props.ticket.users.findIndex((u) => {
        return u.UserID == user.UserID;
    });
    console.log(index);

    this.$page.props.ticket.users.splice(index, 1);
    this.saveTicket(this.$page.props.ticket);
}
