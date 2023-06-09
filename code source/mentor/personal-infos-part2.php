<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Mentorini-mentor</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="stylesheet" href="assets/css/Drag-and-Drop-Multiple-File-Form-Input-upload-Advanced.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/css/theme.bootstrap_4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/Ludens---Create-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Ludens---Sleek-Image-Input-with-Preview.css">
</head>

<body>
    <?php
    session_name('mentor');
    session_start();
    include("connect.php");
    ?>
    <nav class="navbar navbar-light navbar-expand-md fixed-top"
        style="padding-top: 0px;padding-bottom: 0px;background-color: var(--bs-gray-200);">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href="homepage.php">
                <div class="d-flex" style="margin-left: 26px;"><span data-aos="fade-right" data-aos-duration="1000"
                        style="margin-left: -32px;"><img src="assets/img/icons8-dumbbell-50%201.svg" width="48"
                            height="97"><span style="font-family: 'Vidaloka';margin-left: 8px;">MENTORINI</span></span>
                </div>
            </a><button class="navbar-toggler" data-bs-toggle="collapse"><span class="visually-hidden">Toggle
                    navigation</span><span class="navbar-toggler-icon"></span></button></div>
    </nav>
    <div class="container-fluid" style="margin-top: 104px;"><a class="btn btn-link link-primary mb-3" role="button"
            href="services.html"><i class="fas fa-arrow-left"></i>&nbsp;Back</a>
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Create Service</h3>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold"><strong>Credentials</strong></p>
        </div>
        <div class="card-body">
            <div id="modal-open-1">
                <div class="modal fade" role="dialog" tabindex="-1" id="exampleModal-1"
                    aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>add a credential</h4><button class="btn-close" type="button" aria-label="Close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add-credentials.php" method="post" id="form" class="form"
                                    enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label" for="title"><strong>Credential Title:</strong></label>
                                        <input class="form-control" type="text" id="title" placeholder="" name="title"
                                            required>
                                    </div>
                                    <div class="d-flex flex-row gap-5">
                                        <div class="mb-3">
                                            <label class="form-label" for="start_date"><strong>Start
                                                    Date:</strong></label>
                                            <input class="form-control" type="date" id="start_date" placeholder=""
                                                name="start_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="end_date"><strong>End Date:</strong></label>
                                            <input class="form-control" type="date" id="end_date" placeholder=""
                                                name="end_date" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="link"><strong>Link (Optional):</strong></label>
                                        <input class="form-control" type="text" id="link" placeholder="" name="link">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"
                                            for="description"><strong>Description:</strong></label>
                                        <textarea class="form-control" id="description" rows="4" name="description"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="file"><strong>Credential File:</strong></label>
                                        <input class="form-control file_upload" type="file" id="file" name="file"
                                            required>
                                    </div>
                                    <div class="modal-footer" style="padding-left: 0px;">
                                        <div class="mb-3" style="padding-left: 0px;">
                                            <button class="btn btn-primary btn-sm ment-btn-style" type="submit"
                                                style="margin-right: 248px;">Add a credential</button>
                                            <button class="btn btn-warning" style="background-color: rgb(255,139,160);"
                                                type="button" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><button class="btn btn-warning" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal-1">Add a credential&nbsp;</button>
            </div>
            <section></section>
            <div class="row">
                <?php

                // Get the mentor's ID
                $mentor_id = $_SESSION['mentor_id'];

                // Prepare the SQL statement
                $sql = 'SELECT * FROM credentials WHERE mentor_id = :mentor_id';

                // Execute the SQL statement
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':mentor_id', $mentor_id, PDO::PARAM_INT);
                $stmt->execute();

                // Get the results of the query
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Get the credentials from the database
                $credentials = $results;

                // Loop through the credentials and display them
                foreach ($credentials as $credential) {

                    // Get the credential ID
                    $credential_id = $credential['credential_id'];
                    // Get the title of the credential
                    $title = $credential['title'];

                    // Get the description of the credential
                    $description = $credential['description'];

                    // Get the start date of the credential
                    $start_date = $credential['start_date'];

                    // Get the end date of the credential
                    $end_date = $credential['end_date'];

                    // Get the file path of the credential
                    $file_path = $credential['file_path'];

                    // Get the link of the credential
                    $link = $credential['link'];
                    // Extract the year from the start date
                    $start_year = substr($start_date, 0, 4);

                    // Extract the year from the end date
                    $end_year = substr($end_date, 0, 4);

                    // Display the credential
                    ?>

                            <div class="col-12 col-sm-12 col-md-11 col-lg-4" style="margin-top: 12px;">
                                <h5 class="fs-6">
                                    <?php echo $start_year ?>-
                                    <?php echo $end_year ?>
                                </h5><label class="form-label fs-6 fw-bold">
                                    <?php echo $title ?><a href="<?php echo $link ?>"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                            class="bi bi-link-45deg" style="font-size: 30px;color: #7a63ff;">
                                            <path
                                                d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z">
                                            </path>
                                            <path
                                                d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z">
                                            </path>
                                        </svg></a>&nbsp;
                                </label>
                                <h6 class="fs-6" style="text-align: justify;">
                                    <?php echo $description ?>
                                </h6><a href="<?php echo $file_path ?>" download="filename.pdf"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-file-pdf-fill pdficon"
                                        style="font-size: 60px;color: var(--bs-danger);">
                                        <path
                                            d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z">
                                        </path>
                                        <path fill-rule="evenodd"
                                            d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z">
                                        </path>
                                    </svg></a>
                                <div id="modal-open" style="margin-top: 14px;">
                                    <div class="modal fade" role="dialog" tabindex="-1"
                                        id="exampleModalEdit<?php echo $credential_id ?>" aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>edit credential</h4><button class="btn-close" type="button"
                                                        aria-label="Close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="edit-credentials.php?credential_id=<?php echo $credential_id; ?>" method="post" id="form" class="form"
                                                        enctype="multipart/form-data">
                                                        <div class="mb-3"></div>
                                                        <div class="d-flex flex-row gap-5">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="address">
                                                                    <strong>Credential</strong>
                                                                </label>
                                                                <input class="form-control" type="text" id="address-3"
                                                                    placeholder="" name="title" value="<?php echo $title ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="address">
                                                                    <strong>Start-date</strong>
                                                                </label>
                                                                <input class="form-control" type="date" id="address-5"
                                                                    placeholder="" name="start_date" value="<?php echo $start_date ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="address">
                                                                        <strong>End-date</strong>
                                                                    </label>
                                                                    <input class="form-control" type="date" id="address-2"
                                                                        placeholder="" name="end_date" value="<?php echo $end_date ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="address">
                                                                            <strong>Link (Optional):</strong>
                                                                        </label>
                                                                        <input class="form-control" type="text" id="address-4"
                                                                            placeholder="" name="link" value="<?php echo $link ?>">
                                                                        </div>
                                                                        <label class="form-label"
                                                                            for="city"><strong>Description:</strong></label><textarea
                                                                            class="form-control" id="signature-5" rows="4"
                                                                            name="description" ><?php echo $description ?></textarea>
                                                                        </div>
                                                                        <section>
                                                                            <div class="container-fluid">
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <label class="col-form-label" for="city"><strong>Credential
                                                                                                file:</strong></label>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-12 col-md-8 col-lg-8 offset-sm-0 offset-md-2">
                                                                                        <div class="file-upload-wrapper">
                                                                                            <div class="view file-upload"
                                                                                                style="padding-bottom: 7px;padding-right: 4px;">
                                                                                        <input class="form-control file_upload" type="file" id="input-file-now" placeholder="Select a file" value="<?php echo $file_path ?>" name="file">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                            <div class="modal-footer">
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-primary btn-sm ment-btn-style" type="submit"
                                                                                        style="margin-right: 260px;">
                                                                                        Update Credential
                                                                                    </button>
                                                                                    <button class="btn btn-warning"
                                                                                        style="background-color: rgb(255,139,160);" type="button"
                                                                                        data-bs-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><a class="btn btn-danger btn-icon-split" role="button" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModalDelete<?php echo $credential_id ?>"><span
                                            class="text-white-50 icon"><i class="fas fa-trash"></i></span><span
                                            class="text-white text">Delete</span></a><button class="btn btn-warning" type="button"
                                        data-bs-toggle="modal" data-bs-target="#exampleModalEdit<?php echo $credential_id ?>"
                                        style="margin-left: 50px;"><i class="far fa-edit" style="font-size: 17px;"></i></button>
                                    <div class="modal fade" role="dialog" tabindex="-1"
                                        id="exampleModalDelete<?php echo $credential_id ?>" aria-labelledby="exampleModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4>Confirm the Deletion</h4><button class="btn-close" type="button"
                                                        aria-label="Close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete this&nbsp; ?</p>
                                                </div>
                                                <form action="delete-credentials.php?credential_id=<?php echo $credential_id; ?>" method="post" id="form" class="form"
                                                            enctype="multipart/form-data"> 
                                                    <div class="modal-footer"><button type="submit" class="btn btn-danger btn-icon-split">
          <span class="text-white-50 icon"><i class="fas fa-trash"></i></span>
          <span class="text-white text">Delete</span>
        </button>
        <button class="btn btn-warning"
                                                            style="background-color: rgb(255,139,160);" type="button"
                                                            data-bs-dismiss="modal">Close</button></div>
                                                            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold"><strong>Experiences</strong></p>
        </div>
        <div class="card-body">
            <div id="modal-open-3">
                <div class="modal fade" role="dialog" tabindex="-1" id="exampleModalexperience"
                    aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>add an experience</h4><button class="btn-close" type="button" aria-label="Close"
                                    data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add-experiences.php" method="post" id="form" class="form"
                                    enctype="multipart/form-data">
                                    <div class="mb-3"></div>
                                    <div class="d-flex flex-row gap-5">
                                        <div class="mb-3"><label class="form-label"
                                                for="address"><strong>Experience</strong></label><input
                                                class="form-control" type="text" id="address-14" placeholder=""
                                                name="title"></div>
                                        <div class="mb-3"><label class="form-label"
                                                for="address"><strong>Start-date</strong></label><input
                                                class="form-control" type="date" id="address-15" placeholder=""
                                                name="start_year"></div>
                                        <div class="mb-3"><label class="form-label"
                                                for="address"><strong>end-date</strong></label><input
                                                class="form-control" type="date" id="address-16" placeholder=""
                                                name="end_year"></div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-3"><label class="form-label" for="address"><strong>Link
                                                    (Optional):</strong></label><input class="form-control" type="text"
                                                id="address-17" placeholder="" name="link"></div><label
                                            class="form-label" for="city"><strong>Description:</strong></label><textarea
                                            class="form-control" id="signature-10" rows="4" name="description"></textarea>
                                    </div>
                                    <section>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col"><label class="col-form-label"
                                                        for="city"><strong>credential file:</strong></label></div>
                                                <div class="col-sm-12 col-md-8 col-lg-8 offset-sm-0 offset-md-2">
                                                    <div class="file-upload-wrapper">
                                                        <div class="view file-upload"
                                                            style="padding-bottom: 7px;padding-right: 4px;"><input
                                                                class="form-control file_upload" type="file"
                                                                id="input-file-now-3" name="file"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <div class="modal-footer" style="padding-left: 0px;">
                                        <div class="mb-3" style="padding-left: 0px;"><button
                                                class="btn btn-primary btn-sm ment-btn-style" type="submit"
                                                style="margin-right: 248px;">Add a credential</button><button
                                                class="btn btn-warning" style="background-color: rgb(255,139,160);"
                                                type="button" data-bs-dismiss="modal">Close</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><button class="btn btn-warning" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalexperience">Add an experience</button>
            </div>
            <section></section>
           <div class="row">
                <?php

                // Get the mentor's ID
                $mentor_id = $_SESSION['mentor_id'];

                // Prepare the SQL statement
                $sql = 'SELECT * FROM Experiences  WHERE mentor_id = :mentor_id';

                // Execute the SQL statement
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':mentor_id', $mentor_id, PDO::PARAM_INT);
                $stmt->execute();

                // Get the results of the query
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Get the Experiences  from the database
                $Experiences = $results;

                // Loop through the Experiences  and display them
                foreach ($Experiences as $experience) {

                    // Get the experience ID
                    $experience_id = $experience['experience_id'];
                    // Get the title of the experience
                    $title = $experience['title'];

                    // Get the description of the experience
                    $description = $experience['description'];

                    // Get the start date of the experience
                    $start_date = $experience['start_year'];

                    // Get the end date of the experience
                    $end_date = $experience['end_year'];

                    // Get the file path of the experience
                    $file_path = $experience['file_path'];

                    // Get the link of the experience
                    $link = $experience['link'];
                    // Extract the year from the start date
                    $start_year = substr($start_date, 0, 4);

                    // Extract the year from the end date
                    $end_year = substr($end_date, 0, 4);

                    // Display the experience
                    ?>

                                <div class="col-12 col-sm-12 col-md-11 col-lg-4" style="margin-top: 12px;">
                                    <h5 class="fs-6">
                                        <?php echo $start_year ?>-
                                        <?php echo $end_year ?>
                                    </h5><label class="form-label fs-6 fw-bold">
                                        <?php echo $title ?><a href="<?php echo $link ?>"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                class="bi bi-link-45deg" style="font-size: 30px;color: #7a63ff;">
                                                <path
                                                    d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z">
                                                </path>
                                                <path
                                                    d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z">
                                                </path>
                                            </svg></a>&nbsp;
                                    </label>
                                    <h6 class="fs-6" style="text-align: justify;">
                                        <?php echo $description ?>
                                    </h6><a href="<?php echo $file_path ?>" download="filename.pdf"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                            viewBox="0 0 16 16" class="bi bi-file-pdf-fill pdficon"
                                            style="font-size: 60px;color: var(--bs-danger);">
                                            <path
                                                d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z">
                                            </path>
                                        </svg></a>
                                    <div id="modal-open" style="margin-top: 14px;">
                                        <div class="modal fade" role="dialog" tabindex="-1"
                                            id="exampleModalEditExp<?php echo $experience_id ?>" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>edit experience</h4><button class="btn-close" type="button"
                                                            aria-label="Close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="edit-experiences.php?experience_id=<?php echo $experience_id; ?>" method="post" id="form" class="form"
                                                            enctype="multipart/form-data">
                                                            <div class="mb-3"></div>
                                                            <div class="d-flex flex-row gap-5">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="address">
                                                                        <strong>experience</strong>
                                                                    </label>
                                                                    <input class="form-control" type="text" id="address-3"
                                                                        placeholder="" name="title" value="<?php echo $title ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="address">
                                                                        <strong>Start-date</strong>
                                                                    </label>
                                                                    <input class="form-control" type="date" id="address-5"
                                                                        placeholder="" name="start_date" value="<?php echo $start_date ?>">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="address">
                                                                            <strong>End-date</strong>
                                                                        </label>
                                                                        <input class="form-control" type="date" id="address-2"
                                                                            placeholder="" name="end_date" value="<?php echo $end_date ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="address">
                                                                                <strong>Link (Optional):</strong>
                                                                            </label>
                                                                            <input class="form-control" type="text" id="address-4"
                                                                                placeholder="" name="link" value="<?php echo $link ?>">
                                                                            </div>
                                                                            <label class="form-label"
                                                                                for="city"><strong>Description:</strong></label><textarea
                                                                                class="form-control" id="signature-5" rows="4"
                                                                                name="description" ><?php echo $description ?></textarea>
                                                                            </div>
                                                                            <section>
                                                                                <div class="container-fluid">
                                                                                    <div class="row">
                                                                                        <div class="col">
                                                                                            <label class="col-form-label" for="city"><strong>experience
                                                                                                    file:</strong></label>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-sm-12 col-md-8 col-lg-8 offset-sm-0 offset-md-2">
                                                                                            <div class="file-upload-wrapper">
                                                                                                <div class="view file-upload"
                                                                                                    style="padding-bottom: 7px;padding-right: 4px;">
                                                                                            <input class="form-control file_upload" type="file" id="input-file-now" placeholder="Select a file" value="<?php echo $file_path ?>" name="file">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </section>
                                                                                <div class="modal-footer">
                                                                                    <div class="mb-3">
                                                                                        <button class="btn btn-primary btn-sm ment-btn-style" type="submit"
                                                                                            style="margin-right: 260px;">
                                                                                            Update experience
                                                                                        </button>
                                                                                        <button class="btn btn-warning"
                                                                                            style="background-color: rgb(255,139,160);" type="button"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div><a class="btn btn-danger btn-icon-split" role="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModalDeleteExp<?php echo $experience_id ?>"><span
                                                class="text-white-50 icon"><i class="fas fa-trash"></i></span><span
                                                class="text-white text">Delete</span></a><button class="btn btn-warning" type="button"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalEditExp<?php echo $experience_id ?>"
                                            style="margin-left: 50px;"><i class="far fa-edit" style="font-size: 17px;"></i></button>
                                        <div class="modal fade" role="dialog" tabindex="-1"
                                            id="exampleModalDeleteExp<?php echo $experience_id ?>" aria-labelledby="exampleModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>Confirm the Deletion</h4><button class="btn-close" type="button"
                                                            aria-label="Close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                              
                                                        <p>Are you sure you want to delete this&nbsp; ?</p>
                                                    </div>
                                                      <form action="delete-experiences.php?experience_id=<?php echo $experience_id ?>" method="post" id="form" class="form" enctype="multipart/form-data"> 
                                                    <div class="modal-footer"><button type="submit" class="btn btn-danger btn-icon-split">
          <span class="text-white-50 icon"><i class="fas fa-trash"></i></span>
          <span class="text-white text">Delete</span>
        </button>
        <button class="btn btn-warning" style="background-color: rgb(255,139,160);" type="button" data-bs-dismiss="modal">Close</button></div>
                                                            </form>
                                           
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                <?php } ?>
            </div>
        </div>
    </div>
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Availability</p>
        </div>
        <div class="card-body">
            <div id="modal-open-2">
                <div class="modal fade" role="dialog" tabindex="-1" id="exampleModaldate"
                    aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Add availability schedule&nbsp;</h4><button class="btn-close" type="button"
                                    aria-label="Close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="add-availability.php" method="post" id="form" class="form"
                                                    enctype="multipart/form-data">
                                    <div class="mb-3"><label class="form-label" for="signature"><strong>Session
                                                times</strong></label></div>
                                    <div><input class="form-control mb-2 d-inline" name="startTime" id="myTime" type="time"
                                            onchange="onTimeChange()" style="width: 25%;">
                                        <p class="d-inline mx-2">Start time:&nbsp;<span id="displayTime">--:-- --</span>
                                        </p>
                                    </div>
                                    <div><input class="form-control mb-2 d-inline" id="myTime-1" name="endTime" type="time"
                                            onchange="onTimeChange1()" style="width: 25%;">
                                        <p class="d-inline mx-2">End time:&nbsp;<span id="displayTime-1">--:-- --</span>
                                        </p>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-2" value="Monday">
            <label class="form-check-label" for="formCheck-2"><strong>Monday</strong></label>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-3" value="Tuesday">
            <label class="form-check-label" for="formCheck-3"><strong>Tuesday</strong></label>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-7" value="Wednesday">
            <label class="form-check-label" for="formCheck-7"><strong>Wednesday</strong></label>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-6" value="Thursday">
            <label class="form-check-label" for="formCheck-6"><strong>Thursday</strong></label>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-5" value="Friday">
            <label class="form-check-label" for="formCheck-5"><strong>Friday</strong></label>
        </div>
    </div>
    <div>
        <div class="form-check">
            <input class="form-check-input" name="days" type="radio" id="formCheck-4" value="Saturday">
            <label class="form-check-label" for="formCheck-4"><strong>Saturday</strong></label>
        </div>
    </div>
</div>
                                    <div class="modal-footer"><button class="btn btn-warning" type="submit">Add<svg
                                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted"
                                                style="font-size: 20px;margin-left: 9px;">
                                                <path
                                                    d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                                                </path>
                                            </svg>&nbsp;</button><button class="btn btn-warning"
                                            style="background-color: rgb(255,139,160);" type="button"
                                            data-bs-dismiss="modal">Close</button></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><button class="btn btn-warning" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModaldate">Add<svg xmlns="http://www.w3.org/2000/svg" width="1em"
                        height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-plus-square-dotted"
                        style="font-size: 20px;margin-left: 9px;">
                        <path
                            d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                        </path>
                    </svg>&nbsp;</button>
            </div>
            <div class="row">
<?php
// Get the mentor's ID
$mentor_id = $_SESSION['mentor_id'];

// Prepare the SQL statement
$sql = 'SELECT * FROM Availability WHERE mentor_id = :mentor_id';

// Execute the SQL statement
$stmt = $db->prepare($sql);
$stmt->bindValue(':mentor_id', $mentor_id, PDO::PARAM_INT);
$stmt->execute();

// Get the results of the query
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get the availability data from the database
$availability = $results;

// Loop through the availability and display them
foreach ($availability as $item) {

    // Get the availability ID
    $availability_id = $item['availability_id'];

    // Get the availability days
    $availability_days = $item['availability_days'];

    // Get the start time of the availability
    $start_time = $item['start_time'];

    // Get the end time of the availability
    $end_time = $item['end_time'];
    ?>

                        <div class="col-md-6">
                            <div class="mb-3"><label class="form-label" for="signature"><strong>Session times</strong></label>
                            </div>
                            <h6 class="fs-6" style="text-align: justify;"><?php echo $availability_days ?>: <?php echo $start_time ?>&nbsp;<svg
                                    xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    viewBox="0 0 16 16" class="bi bi-clock">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                    </path>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                </svg>&nbsp;<?php echo $end_time ?></h6>
                            <div class="mb-3"></div>
                            <div id="modal-open-7">
                                <div class="modal fade" role="dialog" tabindex="-1" id="exampleModaldateAvail<?php echo $availability_id ?>"
                                    aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>Update availability schedule</h4><button class="btn-close" type="button"
                                                    aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="edit-availability.php" method="post" enctype="multipart/form-data">
                                                    <div class="mb-3"><label class="form-label" for="signature"><strong>Session
                                                                times</strong></label></div>
                                                    <div><input class="form-control mb-2 d-inline" id="myTime-3" type="time" name="start_time" value="<?php echo $start_time; ?>"
                                                                onchange="onTimeChange3()" style="width: 25%;">
                                                            <p class="d-inline mx-2">Start time:&nbsp;<span id="displayTime-3">--:--
                                                                    --</span></p>
                                                        </div>
                                                        <div><input class="form-control mb-2 d-inline" id="myTime-4" type="time"  value="<?php echo $end_time; ?>" name="end_time"
                                                                    onchange="onTimeChange4()" style="width: 25%;">
                                                                <p class="d-inline mx-2">End time:&nbsp;<span id="displayTime-4">--:--
                                                                        --</span></p>
                                                            </div>
                                                           <div class="d-flex flex-wrap gap-3">
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" name="days" type="radio" id="formCheck-2" value="Monday" <?php if ($availability_days == "Monday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-2"><strong>Monday</strong></label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" name="days" type="radio" id="formCheck-3" value="Tuesday" <?php if ($availability_days == "Tuesday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-3"><strong>Tuesday</strong></label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" name="days" type="radio" id="formCheck-7" value="Wednesday" <?php if ($availability_days == "Wednesday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-7"><strong>Wednesday</strong></label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" name="days" type="radio" id="formCheck-6" value="Thursday" <?php if ($availability_days == "Thursday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-6"><strong>Thursday</strong></label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" name="days" type="radio" id="formCheck-5" value="Friday" <?php if ($availability_days == "Friday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-5"><strong>Friday</strong></label>
                </div>
            </div>
            <div>
                <div class="form-check">
                    <input class="form-check-input" name="days" type="radio" id="formCheck-4" value="Saturday" <?php if ($availability_days == "Saturday")
                            echo "checked"; ?>>
                    <label class="form-check-label" for="formCheck-4"><strong>Saturday</strong></label>
                </div>
            </div>
        </div>
                                                    <div class="modal-footer"><button class="btn btn-warning"
                                                            type="submit">Edit<svg xmlns="http://www.w3.org/2000/svg"
                                                                width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                                class="bi bi-plus-square-dotted"
                                                                style="font-size: 20px;margin-left: 9px;">
                                                                <path
                                                                    d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                                                                </path>
                                                            </svg>&nbsp;</button><button class="btn btn-warning"
                                                            style="background-color: rgb(255,139,160);" type="button"
                                                            data-bs-dismiss="modal">Close</button></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div><button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModaldateAvail<?php echo $availability_id ?>" style="margin-right: 152px;">&nbsp;<i
                                        class="far fa-edit" style="font-size: 17px;"></i></button>
                                <div class="modal fade" role="dialog" tabindex="-1" id="exampleModalDeleteAvail<?php echo $availability_id ?>"
                                    aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                        
                                                <h4>Confirm the Deletion</h4><button class="btn-close" type="button"
                                                    aria-label="Close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <p>Are you sure you want to delete this&nbsp; ?</p>
                                            </div>
                                            <form action="delete-availability.php?availability_id=<?php echo$availability_id?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-footer"><button type="submit" class="btn btn-danger btn-icon-split">
          <span class="text-white-50 icon"><i class="fas fa-trash"></i></span>
          <span class="text-white text">Delete</span>
        </button><button class="btn btn-warning"
                                                    style="background-color: rgb(255,139,160);" type="button"
                                                    data-bs-dismiss="modal">Close</button>
                                                </div>
                                                </form>
                                        </div>
                                    </div>
                                </div><a class="btn btn-danger btn-icon-split" role="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalDeleteAvail<?php echo $availability_id ?>"><span class="text-white-50 icon"><i
                                            class="fas fa-trash"></i></span><span class="text-white text">Delete</span></a>
                            </div>
                            <div class="mb-3"></div>
                        </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="text-end mb-3"><a href="profile.php"><button class="btn btn-primary btn-lg" type="submit"
                style="margin-right: 53px;">NEXT</button></a></div>
                <script>
</script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/jquery.tablesorter.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-filter.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.2/js/widgets/widget-storage.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script
        src="assets/js/Ludens---Create-Edit-Form-Ludens---1-Index-Table-with-Search--Sort-Filters-v20-1.js"></script>
    <script src="assets/js/Ludens---Create-Edit-Form-Ludens---1-Index-Table-with-Search--Sort-Filters-v20.js"></script>
    <script src="assets/js/Ludens---Create-Edit-Form-theme.js"></script>
    <script src="assets/js/Ludens---Sleek-Image-Input-with-Preview-dependencies.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/zectStudio_12H-Time-Format-scripts.js"></script>
</body>

</html>