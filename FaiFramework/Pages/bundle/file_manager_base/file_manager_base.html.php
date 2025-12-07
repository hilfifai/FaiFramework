<div class="file-manager-container">
            <div class="left-panel">
                <div class="panel-header">
                    <h3>Folders</h3>
                    <button id="new-folder-btn" class="icon-btn" title="New Folder">
                        <i class="fas fa-folder-plus"></i>
                    </button>
                </div>
                <div class="folder-tree" id="folder-tree"></div>
            </div>
            <!-- File List -->
            <div class="right-panel">
                <div class="cm-address-bar-search" clear>
                    <div class="address-search">
                        <div class="pos">
                            <input type="text" class="address-search-input" id="breadcrumbs">
                            <div class="cm-button address-button">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                            <div class="address-short-btn"></div>
                        </div>
                    </div>
                    <div class="search-file-and-folder">
                        <div class="pos">
                            <input placeholder="Search.." type="text" class="files-search-input">
                            <div class="cm-button file-search-button">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="theme-structure big-file-manager" id="file-list">
                    <ul></ul>
                </div>
            </div>
        </div>