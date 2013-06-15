plugin.tx_responsivetemplate.responsiveslider {
	view {
		templateRootPath = EXT:responsive_template/Resources/Private/Slider/Frontend/Templates
		partialRootPath = EXT:responsive_template/Resources/Private/Slider/Frontend/Templates
		layoutRootPath = EXT:responsive_template/Resources/Private/Slider/Frontend/Templates
	}
	persistence {
		 storagePid = {$plugin.tx_responsivetemplate.settings.sliderPid}
	}
	features {
		# uncomment the following line to enable the new Property Mapper.
		# rewrittenPropertyMapper = 1
	}
}



 # Module configuration
module.tx_responsivetemplate{
	persistence {
		storagePid = {$plugin.tx_responsivetemplate.settings.sliderPid}
	}
	view{
		templateRootPath = EXT:responsive_template/Resources/Private/Slider/Backend/Templates
		partialRootPath  = EXT:responsive_template/Resources/Private/Slider/Backend/Partials
		layoutRootPath   = EXT:responsive_template/Resources/Private/Slider/Backend/Layouts
	}
        settings {
                checkStoragePid =  {$plugin.tx_responsivetemplate.settings.sliderPid}
        }
}

page.includeCSS {
    tx_responsivetemplate_slider_1 = EXT:responsive_template/Resources/Public/css/sliderFrontend.css
}
page.includeJSFooter {
    tx_responsive_template_slider = EXT:responsive_template/Resources/Public/javascript/slider.js

}