<?php
script('rocket_integration', 'admin');
style('rocket_integration', 'style');
?>

<div class="section">
    <h2> Rocket Chat integration </h2>

    <p>
        <strong>Note !</strong> In order to invite members to a conversion about a file a Rocket Chat setting must
        be enabled.
    </p>
    <p>
        As a Rocket Chat admin go to "Administration -> Layout -> Interface" and check "Show top navbar in embedded layout".
    </p>

    <hr>

    <?php if ($_['rocketUrl']) { ?>
        <p> Your URL: <?= p($_['rocketUrl']) ?> </p>

        <hr>

        <p> Your Custom OAuth Name </p>

        <form action="<?= p($_['updateCustomOAuthNameUrl']) ?>" method="post">
            <input type="text"
                   value="<?= p($_['customOAuthName']) ?>"
                   placeholder="Enter Custom OAuth name"
                   class="input"
                   name="customOauthName"
                   id="customOauthName"
                   required>

            <button type="submit"> Update </button>
        </form>

        <hr>

        <p> You have setup your Personal Access Token and your User ID. </p>

        <form action="<?= p($_['resetConfig']) ?>" method="post">
            <button type="submit"> Reset data </button>
        </form>
    <?php } else { ?>
        <form action="<?= p($_['formUrl']) ?>" method="post">
            <div>
                <label for="url">Rocket Chat installation URL</label>

                <input type="text"
                       placeholder="Enter Rocket Chat URL"
                       class="input"
                       name="url"
                       id="url"
                       required
                       style="width: 20rem;">
            </div>

            <div>
                <label for="url">Rocket Chat Custom OAuth Name (Optional)</label>

                <input type="text"
                       placeholder="Enter Rocket Chat Custom OAuth Name"
                       class="input"
                       name="customOauthName"
                       id="customOauthName"
                       style="width: 20rem;">
            </div>

            <div>
                <h5> Personal Access Token </h5>

                <p>
                    You can generate personal access tokens in your profile page
                    (Profile -> My Account -> Security -> Personal Access Tokens).
                </p>

                <p>
                    The tokens that will be generated are irrecoverable, once generated, you must save it in a safe
                    place, if the token is lost or forgotten, you can regenerate or delete the token.
                </p>
            </div>

            <div>
                <label for="personalAccessToken"> Personal Access Token </label>

                <input type="text"
                       placeholder="Enter Personal Access Token"
                       class="input"
                       required
                       name="personalAccessToken"
                       id="personalAccessToken"
                       style="width: 40rem;">
            </div>

            <div>
                <label for="userId"> User ID </label>

                <input type="text"
                       placeholder="Enter User ID"
                       class="input"
                       required
                       name="userId"
                       id="userId"
                       style="width: 40rem;">
            </div>

            <button type="submit"> Submit </button>
        </form>
    <?php } ?>
</div>
