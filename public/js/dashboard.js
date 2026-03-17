function showPanel(id, element) {
    document.querySelectorAll('.section-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
    document.getElementById('panel-' + id).classList.add('active');
    element.classList.add('active');
}
