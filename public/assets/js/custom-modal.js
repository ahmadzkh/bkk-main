const dialog = document.querySelector("dialog"),
    invoke = document.getElementById("invoke"),
    output = document.querySelector("output"),
    cancel = dialog.querySelector(".cancel");

if (typeof dialog.showModal !== "function") {
    output.value = `Modal dialog not supported`;
}

invoke.addEventListener("click", () => {
    // dialog.returnValue = false;
    dialog.showModal();
});

// dialog.addEventListener('close', () => {
//     dialog.returnValue = dialog.returnValue.toLowerCase() === 'true';
//     output.value = dialog.returnValue;
// });

buttoncancelCSM.addEventListener("click", () => {
    dialog.close(false);
});

cancelCSM.addEventListener("click", () => {
    dialog.close(false);
});

dialog.addEventListener("click", (e) => {
    const rect = dialog.getBoundingClientRect();

    const inDialog =
        rect.top <= e.clientY &&
        e.clientY <= rect.top + rect.height &&
        rect.left <= e.clientX &&
        e.clientX <= rect.left + rect.width;

    !inDialog && dialog.close();
});
