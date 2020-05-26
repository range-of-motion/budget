#package.xml file is recreated on the fly by Copado, no need to track unnecessary changes of this file
package.xml

#Managed packages can trigger the installation or uninstallation of applications, it is  
#recommended to manage this outside git

installedPackages/*

#if you are not customizing a managed package, you can keep your repository clean by ignoring 
#all files for that package. For example, to ignore all files of the "Copado" managed package
#just add to your gitignore file the following text: *copado__*
#if you will be customizing managed packages, make sure that the same version of the package 
#is installed on all your environments so that deployments will only update existing 
#managed components. Creation of managed components is not permitted by the API.
#It is recommended that you ignore managed components that cannot be modified 
#since there is no need to track them in Git, like for example:

classes/copado__*
triggers/copado__*
pages/copado__*

#Translations are complex since get updated indirectly across multiple files, they can make a deployment fail
#if a field is translated in source and it doesn't exist on destination. 
#If you are committing incrementally new fields and new Translations you can track them in Git, just be careful. 
#If you choose  to ignore them in Git, you can always create a deployment with the Copado Deployer "Translation" Step. 

# translations/*
# objectTranslations/*

#Sites which has Domain mapping has environment specific information. 
#Make sure you setup Copado Environment Variables to make sites config files environment agnostic.
#Until the above is achieved, you can ignore them as follows

# sites/*
# siteDotComSites/*

#Documents are mostly created in Production and are not deployed between Sandboxes. You can safely ignore them in Git.
documents/*
