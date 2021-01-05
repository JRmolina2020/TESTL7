module.exports = {
    methods: {
        add(id, actions) {
            this.$validator.validate().then(valid => {
                if (valid) {
                    if (this.status == false) {
                        Swal.fire({
                            position: "center",
                            imageUrl:
                                "https://lavchat-user.lavenirapps.co/assets/images/loading.gif",
                            imageWidth: 200,
                            imageHeight: 200,
                            title: "Cargando......",
                            showConfirmButton: false
                        });
                    }
                    if (id) {
                        let url = `${this.url}/${id}`;
                        axios
                            .put(url, this.form)
                            .then(response => {
                                this.$store.dispatch(actions);
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: `${response.data.message}`,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#model").modal("hide");
                                this.clear();
                                this.status = true;
                            })
                            .catch(error => {
                                console.log(error.response);
                            });
                    } else {
                        axios
                            .post(this.url, this.form)
                            .then(response => {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: `${response.data.message}`,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#model").modal("hide");
                                this.$store.dispatch(actions);
                                this.clear();
                                this.status = true;
                            })
                            .catch(error => {
                                console.log(error.response);
                            });
                    }
                }
            });
        },
        formatKey() {
            if (this.form.name) {
                this.form.name = this.form.name.toString();
                this.form.name =
                    this.form.name.charAt(0).toUpperCase() +
                    this.form.name.slice(1);
            }
        }
    }
};
