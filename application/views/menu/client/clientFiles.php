		<div id="elfinder"></div>
		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : '<?php echo base_url("index.php/menu/client/elfinder_init") ?>	',  // connector URL (REQUIRED)
					 lang: 'es',             // language (OPTIONAL)
					 handlers : {
					    dblclick : function(event, elfinderInstance) {
					      elfinderInstance.exec('download');
					    }
					  },

					  getFileCallback : function(files, fm) {
					    return false;
					  },

					  commandsOptions : {
					    quicklook : {
					      width : 640,  // Set default width/height voor quicklook
					      height : 480
					    }
					  }
				}).elfinder('instance');
			});
		</script>