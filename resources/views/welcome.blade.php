<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="mx-5">
        <h1 class="my-5">Learning Activity Year 1 (January s/d June 2022)</h1>

        <button class="btn btn-primary my-2 float-right" data-toggle="modal" data-target="#add-modal">Tambah</button>

        <table id="activity-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">Metode</th>
                    <th scope="col">Januari</th>
                    <th scope="col">Februari</th>
                    <th scope="col">Maret</th>
                    <th scope="col">April</th>
                    <th scope="col">Mei</th>
                    <th scope="col">Juni</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="form-tambah">
                            <div class="form-group">
                                <label for="form-name" class="label label-default">Name</label>
                                <input type="text" class="form-control" placeholder="Activity name" name="name"
                                    id="form-name"></input>
                            </div>

                            <div class="form-group">
                                <label for="form-date-start" class="label label-default">Date Start</label>
                                <input type="date" class="form-control" placeholder="Date Start" name="date_start"
                                    id="form-date-start"></input>
                            </div>

                            <div class="form-group">
                                <label for="form-date-end" class="label label-default">Date End</label>
                                <input type="date" class="form-control" placeholder="Date End" name="date_end"
                                    id="form-date-end"></input>
                            </div>

                            <div class="form-group">
                                <label for="form-method" class="label label-default">Metode</label>
                                <select class="form-select form-control" aria-label="Default select example"
                                    name="method_id" id="form-method">
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="save-btn">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>



    <script>
        const main = () => {
            const init = async () => {
                $("#activity-table tbody").html("");

                const activities_data = await $.ajax({
                    url: "/api/v1/activities",
                    success: (data) => data
                }, );

                const methods_data = await $.ajax({
                    url: "/api/v1/methods",
                    success: (data) => {
                        data.forEach((method) => {
                            $("#form-method").append(`
                            <option value="${method.id}">${method.name}</option>
                        `);
                        })

                        return data;
                    }
                })

                methods_data.forEach((method) => {
                    const activities_january = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 0 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })

                    const activities_february = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 1 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })


                    const activities_march = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 2 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })

                    const activities_april = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 3 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })

                    const activities_may = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 4 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })


                    const activities_june = activities_data.map((activity) => {
                        if (new Date(activity.date_start).getMonth() === 5 && activity
                            .method_id ===
                            method.id) {
                            return `
                            <li>
                                ${activity.name}
                                <br>
                                <span class="text-primary">(${moment(activity.date_start).calendar()}) - (${moment(activity.date_end).calendar()})</span>
                            </li>
                        `;
                        }
                    })
                    $("#activity-table tbody").append(`
                    <tr>
                        <td>${method.name}</td>
                        <td>
                            <ul>
                                ${activities_january.join("")}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                ${activities_february.join("")}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                ${activities_march.join("")}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                ${activities_april.join("")}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                ${activities_may.join("")}
                            </ul>
                        </td>
                        <td>
                            <ul>
                                ${activities_june.join("")}
                            </ul>
                        </td>
                    </tr>
                `);
                })
            }



            $("#save-btn").click(() => {
                const form_array = $("#form-tambah").serializeArray();
                let form_json = {};

                for (let i = 0; i < form_array.length; i++) {
                    form_json = {
                        ...form_json,
                        [form_array[i].name]: form_array[i].value
                    }
                }

                $.ajax({
                    type: 'post',
                    url: '/api/v1/activities',
                    data: JSON.stringify(form_json),
                    contentType: "application/json; charset=utf-8",
                    success: function(data) {
                        alert("Data successfully saved to database!");
                    }
                });

                init();
            });

            init();
        }

        main();
    </script>
</body>

</html>
