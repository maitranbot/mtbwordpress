<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class GalatiaEdgeSkin extends GalatiaEdgeClassSkinAbstract {
	
    /**
     * Skin constructor. Hooks to galatia_edge_admin_scripts_init and galatia_edge_enqueue_admin_styles
     */
	public function __construct() {
		$this->skinName = 'edge';
		
		// Admin register scripts and styles
		add_action( 'galatia_edge_action_admin_scripts_init', array( $this, 'registerStyles' ) );
		add_action( 'galatia_edge_action_admin_scripts_init', array( $this, 'registerScripts' ) );
		
		// Admin enqueue scripts and styles
		add_action( 'galatia_edge_action_enqueue_admin_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'galatia_edge_action_enqueue_admin_scripts', array( $this, 'enqueueScripts' ) );
		
		// Admin enqueue meta box scripts and styles
		add_action( 'galatia_edge_action_enqueue_meta_box_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'galatia_edge_action_enqueue_meta_box_scripts', array( $this, 'enqueueScripts' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

    /**
     * Method that registers skin scripts
     */
	public function registerScripts() {
		
		$this->scripts['edgtf-ui-admin-skin'] = array(
			'path'       => 'assets/js/edgtf-ui.js',
			'dependency' => array()
		);
		
		foreach ( $this->scripts as $scriptHandle => $script ) {
			galatia_edge_register_skin_script( $scriptHandle, $script['path'], $script['dependency'] );
		}
	}

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
	    $this->styles['edgtf-bootstrap'] = 'assets/css/edgtf-bootstrap.css';
        $this->styles['edgtf-page-admin'] = 'assets/css/edgtf-page.css';
        $this->styles['edgtf-options-admin'] = 'assets/css/edgtf-options.css';
        $this->styles['edgtf-meta-boxes-admin'] = 'assets/css/edgtf-meta-boxes.css';
        $this->styles['edgtf-ui-admin'] = 'assets/css/edgtf-ui/edgtf-ui.css';
        $this->styles['edgtf-forms-admin'] = 'assets/css/edgtf-forms.css';
        $this->styles['edgtf-import'] = 'assets/css/edgtf-import.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            galatia_edge_register_skin_style($styleHandle, $stylePath);
        }
    }

    /**
     * Method that renders options page
     *
     * @see EdgeSkin::getHeader()
     * @see EdgeSkin::getPageNav()
     * @see EdgeSkin::getPageContent()
     */
    public function renderOptions() {
        global $galatia_edge_global_Framework;
        $tab    = galatia_edge_get_admin_tab();
        $active_page = $galatia_edge_global_Framework->edgtOptions->getAdminPageFromSlug($tab);
        if ($active_page == null) return;
        ?>
        <div class="edgtf-options-page edgtf-page">
            <?php $this->getHeader($active_page); ?>
            <div class="edgtf-page-content-wrapper">
                <div class="edgtf-page-content">
                    <div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

    /**
     * Method that renders header of options page.
     * @param bool $show_save_btn whether to show save button. Should be hidden on import page
     *
     * @see GalatiaEdgeClassSkinAbstract::loadTemplatePart()
     */
    public function getHeader($activePage = '', $show_save_btn = true) {
        $this->loadTemplatePart('header', array('active_page' => $activePage, 'show_save_btn' => $show_save_btn));
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $is_import_page if is import page highlighted that tab
     *
     * @see GalatiaEdgeClassSkinAbstract::loadTemplatePart()
     */
    public function getPageNav($tab, $is_import_page = false, $is_backup_options_page = false) {
        $this->loadTemplatePart('navigation', array(
            'tab' => $tab,
            'is_import_page' => $is_import_page,
			'is_backup_options_page' => $is_backup_options_page
        ));
    }

    /**
     * Method that loads current page content
     *
     * @param GalatiaEdgeClassAdminPage $page current page to load
     * @see GalatiaEdgeClassSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page) {
        $this->loadTemplatePart('content', array('page' => $page));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

	/**
	 * Method that loads content for backup page
	 */
	public function getBackupOptionsContent() {
		$this->loadTemplatePart('backup-options');
	}

	/**
	 * Method that loads anchors and save button template part
	 *
	 * @param GalatiaEdgeClassAdminPage $page current page to load
	 * @see GalatiaEdgeClassSkinAbstract::loadTemplatePart()
	 */
    public function getAnchors($page) {
        $this->loadTemplatePart('anchors', array('page' => $page));

    }
	
	/**
	 * Method that renders import page
	 *
	 *  @see EdgeSkin::getHeader()
	 *  @see EdgeSkin::getPageNav()
	 *  @see EdgeSkin::getImportContent()
	 */
    public function renderImport() { ?>
        <div class="edgtf-options-page edgtf-page">
            <?php $this->getHeader('', false); ?>
            <div class="edgtf-page-content-wrapper">
                <div class="edgtf-page-content">
                    <div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

	/**
	 * Method that renders backup options page
	 *
	 * @see EdgeSkin::getHeader()
	 * * @see EdgeSkin::getPageNav()
	 * * @see EdgeSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="edgtf-options-page edgtf-page">
			<?php $this->getHeader('',false); ?>
			<div class="edgtf-page-content-wrapper">
				<div class="edgtf-page-content">
					<div class="edgtf-page-navigation edgtf-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }

}
?>