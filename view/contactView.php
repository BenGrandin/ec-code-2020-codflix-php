<?php ob_start(); ?>

    <div class="landscape">
        <div class="bg-black">
            <div class="row no-gutters">
                <div class="col-md-6 full-height bg-white">
                    <div class="auth-container">
                        <a href='index.php'><h2><span>Cod</span>'Flix</h2></a>
                        <h3>Nous Contacter</h3>

                        <form method="post" action="index.php?action=contact" class="custom-form">

                            <div class="form-group">
                                <label for="name">Your name</label>
                                <input type="text" name="name" value="" id="name" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="password">Your email</label>
                                <input type="email" name="email" id="email" class="form-control"/>
                            </div>

                            <div class="form-group">
                                <label for="comment">Message</label>
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6 col-md-6 mb-0 mb-sm-2">
                                        <input type="submit" name="Valider" class="btn btn-block bg-red"/>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="index.php" class="btn btn-block bg-blue">Retour</a>
                                    </div>
                                </div>
                            </div>

                            <span class="error-msg"><?= isset($error_msg) ? $error_msg : null; ?></span>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 full-height">
                    <div class="auth-container">
                        <h1>Contact</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $content = ob_get_clean(); ?>

<?php require('view/base.php'); ?>