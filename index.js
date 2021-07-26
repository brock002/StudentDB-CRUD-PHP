// initializing popover
const pop = document.querySelector("#dobPop")
const popover = new bootstrap.Popover(pop)
popover.disable()

// function to validate date of birth
const validateDob = e => {
	const userInput = e.target.value
	const userInputYear = userInput.substring(0, 4)
	const currentYear = new Date().getFullYear()
	if (currentYear - userInputYear < 18) {
		popover.enable()
		popover.show()
		setTimeout(() => {
			popover.hide()
			popover.disable()
		}, 5000)
	}
}

const showPopover = () => {
	popover.enable()
	popover.show()
	setTimeout(() => {
		popover.hide()
		popover.disable()
	}, 5000)
}
