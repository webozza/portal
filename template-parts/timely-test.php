<?php
/**
* Template Name: Timely
*/

get_header();

?>
    <div class="timely-sync-preloader">
        <img src="<?= get_template_directory_uri() . '/img/shimmer-loading-effect.gif' ?>">
    </div>
<?php

/* Handle code generation for API access
--------------------------------------------------------------------*/
?> <script>
    let currentLoc = window.location.href;
    if(currentLoc.indexOf('?code=') == -1) {
        window.location.href = 'https://api.timelyapp.com/1.1/oauth/authorize?response_type=code&redirect_uri=https://cure-portal.local/timely&client_id=pRVYnxXWTFYlo92q1Pw0PrmosVjg0UoLoABZoZXYe0s';
    }
</script> <?php

if( isset($_GET['code']) ) {

    $response_code = $_GET['code'];

    /* Timely API - Get Token
    --------------------------------------------------------------------*/
    $token_curl = curl_init();
    curl_setopt_array($token_curl, array(
        CURLOPT_URL => 'https://api.timelyapp.com/1.1/oauth/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query(array(
            'client_id' => 'pRVYnxXWTFYlo92q1Pw0PrmosVjg0UoLoABZoZXYe0s',
            'client_secret' => 'EQZi9DwhIQHi6W6gPSklmLnAqXY9NhmR1BUhcvWPiCk',
            'redirect_uri' => 'https://cure-portal.local/timely',
            'code' => $response_code,
            'grant_type' => 'authorization_code'
        ))
    ));
    $token_response = curl_exec($token_curl);
    $token = json_decode($token_response);
    curl_close($token_curl);
    
    /* Timely API - Get Users
    --------------------------------------------------------------------*/
    $users_curl = curl_init();
    curl_setopt_array($users_curl, array(
        CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/users',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token->access_token
        )
    ));

    $users_response = curl_exec($users_curl);
    $users = json_decode($users_response, true);
    curl_close($users_curl);
    echo '<script>let timelyData = { users: ' . json_encode($users) . ' }</script>';

    /* Timely API - Get Projects
    --------------------------------------------------------------------*/
    $projects_curl = curl_init();
    curl_setopt_array($projects_curl, array(
        CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/projects',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token->access_token
        )
    ));

    $projects_response = curl_exec($projects_curl);
    $projects = json_decode($projects_response);
    curl_close($projects_curl);
    echo '<script>timelyData["projects"] = ' . json_encode($projects) . '</script>';

    /* Timely API - Get Events
    --------------------------------------------------------------------*/
    $events_curl = curl_init();
    curl_setopt_array($events_curl, array(
        CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/events',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $token->access_token
        )
    ));

    $events_response = curl_exec($events_curl);
    $events = json_decode($events_response);
    curl_close($events_curl);
    echo '<script>timelyData["events"] = ' . json_encode($events) . '</script>';

    /* ProofHub API - Get all Projects
    --------------------------------------------------------------------*/
    $ph_projects_curl = curl_init();
    curl_setopt_array($ph_projects_curl, array(
        CURLOPT_URL => 'https://curecollective.proofhub.com/api/v3/projects',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'User-Agent: AppName (lee.morgan@curecollective.com.au)',
            'X-API-KEY: bb7f3dfb14212df54449865a85627cb8ab207c6b',
        ),
    ));

    $ph_projects = curl_exec($ph_projects_curl);
    echo '<script>let phData = {projects: ' . $ph_projects . '}</script>';
    $ph_projects = json_decode($ph_projects);
    curl_close($ph_projects_curl);

    /* ProofHub API - Get all users
    --------------------------------------------------------------------*/
    $ph_users_curl = curl_init();
    curl_setopt_array($ph_users_curl, array(
        CURLOPT_URL => 'https://curecollective.proofhub.com/api/v3/people',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'User-Agent: AppName (lee.morgan@curecollective.com.au)',
            'X-API-KEY: bb7f3dfb14212df54449865a85627cb8ab207c6b',
        ),
    ));

    $ph_users = curl_exec($ph_users_curl);
    echo '<script>phData["users"] = ' . $ph_users . '</script>';
    $ph_users = json_decode($ph_users);
    curl_close($ph_users_curl);

    /* ProofHub API - Get all project ids for Vyro
    --------------------------------------------------------------------*/
    $vyro_ids = array();
    foreach ($ph_projects as $project) {
        if (strpos($project->title, 'Vyro') !== false) {
            $vyro_ids[] = $project->id;
        }
    }
    $vyro_ids_string = implode(',', $vyro_ids);

    /* ProofHub API - Get all tasks for Vyro
    --------------------------------------------------------------------*/
    $vyro_tasks_curl = curl_init();
    curl_setopt_array($vyro_tasks_curl, array(
        CURLOPT_URL => 'https://curecollective.proofhub.com/api/v3/alltodo?projects=' . $vyro_ids_string,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'User-Agent: AppName (lee.morgan@curecollective.com.au)',
            'X-API-KEY: bb7f3dfb14212df54449865a85627cb8ab207c6b',
        ),
    ));

    $vyro_tasks = curl_exec($vyro_tasks_curl);
    echo '<script>if (!phData.tasks) phData.tasks = {}; phData.tasks.vyro = ' . $vyro_tasks . ';</script>';
    $vyro_tasks = json_decode($vyro_tasks);
    curl_close($vyro_tasks_curl);

    /* Timely API - Get all tasks for Vyro
    --------------------------------------------------------------------*/
    $timely_tasks_curl = curl_init();
    curl_setopt_array($timely_tasks_curl, array(
        CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/forecasts',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$token->access_token
        )
    ));

    $timely_tasks = curl_exec($timely_tasks_curl);
    echo '<script>timelyData["tasks"] = ' . $timely_tasks . '</script>';
    $timely_tasks = json_decode($timely_tasks);
    curl_close($timely_tasks_curl);

    /* Check if tasks from PH exists on Timely for Vyro
    --------------------------------------------------------------------*/
    $users = get_users();
    $timely_task_titles = array();
    $ph_task_titles = array();
    foreach ($timely_tasks as $timely_task) {
        array_push($timely_task_titles, $timely_task->title);
    }
    
    foreach ($vyro_tasks as $cure_task) {
        // Null validation
        $cure_task->logged_hours = $cure_task->logged_hours ?? 0;
        $cure_task->logged_mins = $cure_task->logged_mins ?? 0;
        $cure_task->estimated_hours = $cure_task->estimated_hours ?? 0;
        $cure_task->estimated_mins = $cure_task->estimated_mins ?? 0;
    
        // Format time
        $cure_task_hours_to_mins = $cure_task->estimated_hours * 60;
        $cure_task_total_mins = $cure_task_hours_to_mins + $cure_task->estimated_mins;
    
        // Check if task exists in Timely by title
        $existing_task = null;
    
        foreach ($timely_tasks as $timely_task) {
            if ($timely_task->title === $cure_task->title) {
                $existing_task = $timely_task;
                break;
            }
        }
    
        // Data to push
        $postData = array(
            'forecast' => array(
                'from' => $cure_task->start_date,
                'to' => $cure_task->due_date,
                'estimated_minutes' => $cure_task_total_mins,
                'project_id' => 4101173,
                'title' => $cure_task->title
            )
        );
    
        if ($existing_task) {
            // Update the task
            $timely_task_id = $existing_task->id;
            $postData['forecast']['id'] = $timely_task_id;
    
            // Retrieve the Timely ID using get_field()
            $matching_user = null;
            foreach ($users as $user) {
                $user_id_ph = get_field('userid_ph', 'user_' . $user->ID);
                if (is_array($cure_task->assigned) && in_array($user_id_ph, $cure_task->assigned)) {
                    $matching_user = $user;
                    break;
                } elseif (is_array($cure_task->assigned) && in_array($user_id_ph, $cure_task->assigned)) {
                    $matching_user = $user;
                    break;
                }
            }
    
            if ($matching_user) {
                // Retrieve the Timely ID using get_field()
                $timely_id = get_field('uid_timely', 'user_' . $matching_user->ID);
    
                // Add the Timely ID to the postData array
                $postData['forecast']['users'] = array(
                    array(
                        'id' => $timely_id
                    )
                );
    
                // Update the assigned ID in the postData array
                $postData['forecast']['assigned'] = $cure_task->assigned;
            }
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/forecasts/' . $timely_task_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token->access_token
                )
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
        } else {
            // Create the task
            $cure_task_assigned = $cure_task->assigned;
    
            // Extract the first assigned ID from the array
            $assigned_id = is_array($cure_task_assigned) ? reset($cure_task_assigned) : $cure_task_assigned;
    
            // Find the user with the matching ID in the users array
            $matching_user = null;
            foreach ($users as $user) {
                $user_id_ph = get_field('userid_ph', 'user_' . $user->ID);
                if (is_array($cure_task->assigned) && in_array($user_id_ph, $cure_task->assigned)) {
                    $matching_user = $user;
                    break;
                } elseif ($user_id_ph === (string) $assigned_id) {
                    $matching_user = $user;
                    break;
                }
            }
    
            if ($matching_user) {
                // Retrieve the Timely ID using get_field()
                $timely_id = get_field('uid_timely', 'user_' . $matching_user->ID);
    
                // Add the Timely ID to the postData array
                $postData['forecast']['users'] = array(
                    array(
                        'id' => $timely_id
                    )
                );
    
                // Update the assigned ID in the postData array
                $postData['forecast']['assigned'] = $assigned_id;
            }
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.timelyapp.com/1.1/1029812/forecasts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($postData),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $token->access_token
                )
            ));
    
            $response = curl_exec($curl);
            curl_close($curl);
        }
    }
    
    ?>
        <script>
            jQuery(document).ready(function($) {
                $('.timely-sync-preloader img').hide();
                $('.timely-sync-preloader').append(`
                    <h3>Sync was successful...</h3>
                    <div class="cure-section">
                        <a class="btn-cure-tom" href="/timely">Sync Again</a>
                    </div>
                `);
            })
        </script>
    <?php
  
}


get_footer();
?>