
#<INCLUDE_TYPOSCRIPT: source="FILE: EXT:responsive_template/Configuration/TypoScript/rte_config.ts">

TCEFORM {
    pages {
        alias.disabled = 0
        author.disabled = 1
        author_email.disabled = 1
        lastUpdated.disabled = 1
        newUntil.disabled = 1
        layout {
            disabled = 1
            altLabels {
                0 = Standard
            }
            removeItems = 1,2,3
        }
    }
}



TCEMAIN {
    # If an editor creates a page it should be visible to all editors and admins
    permissions {
        groupid = 1
        user = show, editcontent, edit, new, delete
        group = show, editcontent, edit, new, delete
        everybody = 
    }
    # Translated items will be hidden
    translateToHidden = 1
    clearCacheCmd = all
}




