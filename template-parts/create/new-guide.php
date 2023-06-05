<?php
    $editor_toolbar = array(
        'tinymce' => array(
            'toolbar1' => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink,undo,redo, bullist, numlist',
        ),
        'editor_height' => 200,
        'textarea_rows' => 20,
    );
?>

<div class="main create-new-guide">
    <div class="greetings has-options">
        <h2>Create New Guide</h2>
        <div>
            <a class="btn-cure btn-guide-publish" href="javascript:void(0)">Publish</a>
        </div>
    </div>
    <div class="cure-filters">
        <div class="date-notice">
            <label>Title:</label>
            <input type="text" name="guide_title" value="<?= $_GET['guide_title'] ?>">
        </div>
    </div>
    <div class="guide-content cure-section">
        <label>Content</label>
        <?php wp_editor('', 'guide_content', $editor_toolbar) ?>
    </div>
</div>