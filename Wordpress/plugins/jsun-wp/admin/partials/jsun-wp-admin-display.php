<div id="jsun-home-tab-sec" class="wrap">
    <span class="tooltiptext">Copied!</span>
    <h1>Jsun WP Plugin Admin</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#tab1" class="nav-tab nav-tab-active">REST API Paths</a>
        <a href="#tab2" class="nav-tab">API Key</a>
    </h2>
    <div id="tab1" class="tab-content">
        <h2>REST API Paths</h2>
        <ul>
            <?php 
            $plugin_routes = get_option('jsun_wp_plugin_routes', array());
            $base_url = home_url('/wp-json/' . $this->plugin_name . '/v1');
            foreach ($plugin_routes as $route): 
                $full_path = esc_url($base_url . $route['path']);
            ?>
            <li>
                <input type="text" readonly value="<?php echo $full_path; ?>" onclick="this.select();" />
                <span class="dashicons dashicons-clipboard copy-button" title="Copy" data-path="<?php echo $full_path; ?>"></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="tab2" class="tab-content">
    <?php 
    $jsun_api_keys = get_option('jsun_api_keys', true); 
    if($jsun_api_keys){ 
      ?>
            <div class="copy-button-container">
                <span id="textToCopy"><?php echo $jsun_api_keys; ?></span>
                <span id="copyButton" class="dashicons dashicons-clipboard" title="Copy"></span>                
                <span id="generateNewApiKey" class="dashicons dashicons-update" title="Regenerate"></span>
            </div>
    <?php } else { ?>
        <h2>Generate Api Key</h2>        
        <button id="generateApiKey">Create Key</button>          
    <?php } ?>  
    </div>
</div>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
    
    const copyButton = document.getElementById('copyButton');
    const tooltip = document.querySelector('.tooltiptext');
    copyButton.addEventListener('click', function() {
        const textToCopy = document.getElementById('textToCopy').textContent;
        navigator.clipboard.writeText(textToCopy).then(() => {
            tooltip.classList.add('show');
            setTimeout(() => { tooltip.classList.remove('show'); }, 2000);
        }).catch(err => {
            console.error('Failed to copy text:', err);
        });
    });

    document.querySelectorAll('.copy-button').forEach(button => {
        button.addEventListener('click', function() {
            const pathToCopy = button.getAttribute('data-path');
            navigator.clipboard.writeText(pathToCopy).then(() => {
                tooltip.classList.add('show');
            setTimeout(() => { tooltip.classList.remove('show'); }, 2000);
            }).catch(err => {
                console.error('Failed to copy path:', err);
            });
        });
    });
});

</script>