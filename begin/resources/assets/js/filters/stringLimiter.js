module.exports = function(value, length = 20) {
	return value.length > length ? value.substring(0, length - 3) + '...' : value;
};