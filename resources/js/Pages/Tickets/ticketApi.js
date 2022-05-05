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
